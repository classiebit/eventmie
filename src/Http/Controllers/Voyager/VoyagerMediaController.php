<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use Classiebit\Eventmie\Support\SecureUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Events\MediaFileAdded;
use TCG\Voyager\Http\Controllers\VoyagerMediaController as BaseVoyagerMediaController;

class VoyagerMediaController extends BaseVoyagerMediaController
{
    public function files(Request $request)
    {
        $this->authorize('browse_media');

        try {
            $folder = SecureUpload::sanitizePath($request->folder);
        } catch (Exception $e) {
            return response()->json([]);
        }

        $request->merge(['folder' => $folder === '' ? '/' : '/'.$folder]);

        return parent::files($request);
    }

    public function new_folder(Request $request)
    {
        $this->authorize('browse_media');

        try {
            $folder = SecureUpload::sanitizePath($request->new_folder);
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Invalid path'];
        }

        if ($folder === '' || SecureUpload::isDangerousFilename($folder)) {
            return ['success' => false, 'error' => 'Invalid folder name'];
        }

        $request->merge(['new_folder' => $folder]);

        return parent::new_folder($request);
    }

    public function delete(Request $request)
    {
        $this->authorize('browse_media');

        try {
            $path = SecureUpload::sanitizePath($request->path);
            $files = [];
            foreach ((array) $request->get('files', []) as $file) {
                $name = SecureUpload::sanitizeFilename($file['name'] ?? '');
                if ($name === '' || $name === 'file') {
                    continue;
                }
                $files[] = [
                    'name' => $name,
                    'type' => ($file['type'] ?? 'file') === 'folder' ? 'folder' : 'file',
                ];
            }
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Invalid path'];
        }

        $request->merge(['path' => $path, 'files' => $files]);

        return parent::delete($request);
    }

    public function move(Request $request)
    {
        $this->authorize('browse_media');

        try {
            $path = SecureUpload::sanitizePath($request->path);
            $dest = SecureUpload::sanitizePath($request->destination);
            $files = [];
            foreach ((array) $request->get('files', []) as $file) {
                $name = SecureUpload::sanitizeFilename($file['name'] ?? '');
                if ($name === '' || $name === 'file') {
                    continue;
                }
                $files[] = ['name' => $name, 'type' => $file['type'] ?? 'file'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Invalid path'];
        }

        $request->merge([
            'path'        => $path,
            'destination' => $dest,
            'files'       => $files,
        ]);

        return parent::move($request);
    }

    public function rename(Request $request)
    {
        $this->authorize('browse_media');

        try {
            $folder = SecureUpload::sanitizePath($request->folder_location);
            $filename = SecureUpload::sanitizeFilename($request->filename);
            $newFilename = SecureUpload::sanitizeFilename($request->new_filename);
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Invalid path'];
        }

        if (SecureUpload::isDangerousFilename($filename) || SecureUpload::isDangerousFilename($newFilename)) {
            return ['success' => false, 'error' => __('voyager::media.error_renaming_ext')];
        }

        $oldExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $newExt = strtolower(pathinfo($newFilename, PATHINFO_EXTENSION));
        if ($oldExt === '' || $oldExt !== $newExt || in_array($newExt, SecureUpload::BLOCKED_EXTENSIONS, true)) {
            return ['success' => false, 'error' => __('voyager::media.error_renaming_ext')];
        }

        $request->merge([
            'folder_location' => $folder,
            'filename'        => $filename,
            'new_filename'    => $newFilename,
        ]);

        return parent::rename($request);
    }

    /**
     * Replace Voyager's upload handler.
     *
     * CVE-2024-55417: MIME sniffing can pass while the stored extension stays .php
     * because the client original extension was used. We map MIME → safe extension
     * and re-encode images so polyglot payloads are stripped.
     *
     * CVE-2024-55415: upload_path was used unsanitized in storeAs().
     */
    public function upload(Request $request)
    {
        $this->authorize('browse_media');

        if (!$request->hasFile('file')) {
            return response()->json([
                'success' => false,
                'message' => 'No file uploaded',
                'path'    => '',
            ]);
        }

        try {
            $uploadPath = SecureUpload::sanitizePath($request->upload_path);
            $safeExt = SecureUpload::assertSafeUploadedFile($request->file);
            $filename = SecureUpload::randomFilename($safeExt);
            $storagePath = $uploadPath === '' ? $filename : $uploadPath.'/'.$filename;

            $file = $request->file;
            $mime = $file->getMimeType();
            $disk = Storage::disk($this->filesystem);

            if (config('filesystems.disks.'.$this->filesystem.'.driver', 'local') === 'local') {
                try {
                    SecureUpload::assertInsideDirectory($disk->path(''), $disk->path($storagePath));
                } catch (Exception $e) {
                    throw new Exception('Invalid path');
                }
            }

            if (strpos($mime, 'image/') === 0) {
                $encoded = Image::make($file->getRealPath())
                    ->orientate()
                    ->encode($safeExt === 'jpg' ? 'jpg' : $safeExt, 90);

                Storage::disk($this->filesystem)->put($storagePath, (string) $encoded);
            } else {
                $file->storeAs($uploadPath, $filename, $this->filesystem);
            }

            $storagePath = preg_replace('#/+#', '/', $storagePath);
            $path = preg_replace('/^public\//', '', $storagePath);

            event(new MediaFileAdded($path));

            return response()->json([
                'success' => true,
                'message' => __('voyager::media.success_uploaded_file'),
                'path'    => $path,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'path'    => '',
            ]);
        }
    }

    public function crop(Request $request)
    {
        $this->authorize('browse_media');

        try {
            $uploadPath = SecureUpload::sanitizePath($request->upload_path);
            $originName = SecureUpload::sanitizeFilename($request->originImageName);

            if (SecureUpload::isDangerousFilename($originName)) {
                throw new Exception('Invalid file');
            }

            $ext = strtolower(pathinfo($originName, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'], true)) {
                throw new Exception('Invalid file');
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        $request->merge([
            'upload_path'     => $uploadPath,
            'originImageName' => $originName,
        ]);

        return parent::crop($request);
    }
}
