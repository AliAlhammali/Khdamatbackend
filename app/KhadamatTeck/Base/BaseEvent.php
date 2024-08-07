<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var BaseDTO $dto
     */
    private BaseDTO $dto;
    /**
     * @var BaseModel $model
     */
    private BaseModel $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BaseModel $model, BaseDTO $dto)
    {
        $this->setDto($dto);
        $this->setModel($model);
    }

    /**
     * @param BaseDTO $dto
     *
     * @return BaseEvent
     */
    public function setDto(BaseDTO $dto): BaseEvent
    {
        $this->dto = $dto;
        return $this;
    }

    /**
     * @return BaseDTO
     */
    public function getDto(): BaseDTO
    {
        return $this->dto;
    }

    /**
     * @param BaseModel $model
     *
     * @return BaseEvent
     */
    public function setModel(BaseModel $model): BaseEvent
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return BaseModel
     */
    public function getModel(): BaseModel
    {
        return $this->model;
    }
}
