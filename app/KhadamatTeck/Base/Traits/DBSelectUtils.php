<?php

namespace App\KhadamatTeck\Base\Traits;

use App\KhadamatTeck\Base\BaseDBSelect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class DBSelectUtils
{

    /**
     * @var ?Model
     */
    protected ?Model $model;

    /**
     * @var BaseDBSelect
     */
    protected BaseDBSelect $dbSelect;

    public function __construct(?Model $model, BaseDBSelect $dbSelect)
    {
        $this->model = $model;
        $this->dbSelect = $dbSelect;
    }

    public function dbSelect(): BaseDBSelect
    {
        return $this->dbSelect;
    }

    public function listing(): Builder
    {
        return $this->model?->select($this->dbSelect->listing());
    }

    public function getById(): Builder
    {
        return $this->model?->select($this->dbSelect->getById());
    }

    public function connectListing(): Builder
    {
        return $this->model?->select($this->dbSelect->connectListing());
    }

    public function connectGetById(): Builder
    {
        return $this->model?->select($this->dbSelect->connectGetById());
    }

    public function mobileListing(): Builder
    {
        return $this->model?->select($this->dbSelect->mobileListing());
    }

    public function mobileGetById(): Builder
    {
        return $this->model?->select($this->dbSelect->mobileGetById());
    }
}
