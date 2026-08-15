<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use Classiebit\Eventmie\Support\SecureUpload;
use Illuminate\Http\UploadedFile;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    public function insertUpdateData($request, $slug, $rows, $data)
    {
        foreach ($request->allFiles() as $file) {
            $files = is_array($file) ? $file : [$file];
            foreach ($files as $uploaded) {
                if (!$uploaded instanceof UploadedFile) {
                    continue;
                }

                SecureUpload::assertSafeUploadedFile($uploaded);
            }
        }

        return parent::insertUpdateData($request, $slug, $rows, $data);
    }
}
