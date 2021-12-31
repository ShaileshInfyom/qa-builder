<?php

namespace App\Http\Controllers\API\Desktop;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Desktop\FileUploadAPIRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class FileUploadController extends AppBaseController
{
    /**
     * @param FileUploadAPIRequest $request
     *
     * @return JsonResponse
     */
    public function upload(FileUploadAPIRequest $request): JsonResponse
    {
        $files = $request->file('files');
        foreach ($files as $file) {
            $user = User::first();
            $user->addMedia($file)->toMediaCollection('default', config('app.media_disc'));
        }

        return $this->successResponse('File upload successfully.');
    }
}
