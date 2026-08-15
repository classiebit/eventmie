<?php

namespace Classiebit\Eventmie\Middleware;

use Classiebit\Eventmie\Support\SecureUpload;
use Closure;
use Exception;
use Illuminate\Http\UploadedFile;

class SanitizeVoyagerUploads
{
    /**
     * Block dangerous uploads and path traversal on every Voyager request
     * (media manager and BREAD image/file fields).
     */
    public function handle($request, Closure $next)
    {
        try {
            foreach ($request->allFiles() as $key => $file) {
                $request->files->set($key, SecureUpload::normalizeFileTree($file));
            }
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            abort(422, $e->getMessage());
        }

        foreach (['upload_path', 'path', 'folder', 'destination', 'new_folder', 'folder_location'] as $field) {
            if ($request->has($field) && !is_array($request->input($field))) {
                try {
                    $request->merge([$field => SecureUpload::sanitizePath($request->input($field))]);
                } catch (Exception $e) {
                    abort(422, 'Invalid path');
                }
            }
        }

        foreach (['filename', 'new_filename', 'originImageName'] as $field) {
            if ($request->filled($field)) {
                $name = SecureUpload::sanitizeFilename($request->input($field));
                if (SecureUpload::isDangerousFilename($name)) {
                    abort(422, 'File type is not allowed');
                }
                $request->merge([$field => $name]);
            }
        }

        return $next($request);
    }
}
