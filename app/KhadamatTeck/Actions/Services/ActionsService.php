<?php

namespace App\KhadamatTeck\Actions\Services;

use App\Munjz\Actions\Requests\UploadActionRequest;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Response;
use App\KhadamatTeck\Base\Service;

class ActionsService
{
    private Filesystem $storage;
    public function __construct(string $disk = 'public')
    {
        $this->storage = Storage::disk($disk);
    }

    public function uploadAction(FormRequest $request): Response
    {
        $files = $request->allFiles();
        $paths = [];
        if (is_array($files['file'])) {
            foreach ($files['file'] as $file) {
                $temp = [];
                $temp['path'] = $this->uploadFile($file);
                $paths[] = $temp;
            }
        } else {
            $paths['path'] = $this->uploadFile($files['file']);
        }

        return $this->response()
            ->setData($paths)
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function uploadFile(UploadedFile $file): string
    {
        $fileName = 'files/'.uniqid().$file->getClientOriginalName();
        $path = $this->storage->put($fileName, $file->getContent());
        return $this->storage->url($fileName);
    }
    protected function response(): Response
    {
        return (new Response());
    }
}
