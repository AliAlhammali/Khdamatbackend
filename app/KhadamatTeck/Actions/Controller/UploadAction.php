<?php

namespace App\KhadamatTeck\Actions\Controller;

use App\KhadamatTeck\Actions\Requests\UploadActionRequest;
use App\KhadamatTeck\Actions\Services\ActionsService;

class UploadAction
{
    /**
     * @var ActionsService $actionsService
     */
    private ActionsService $actionsService;

    public function __construct(ActionsService $actionsService)
    {
        $this->actionsService = $actionsService;
    }

    public function __invoke(UploadActionRequest $request)
    {
        return $this->actionsService->uploadAction($request);
    }
}
