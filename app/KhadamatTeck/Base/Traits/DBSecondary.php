<?php

namespace App\KhadamatTeck\Base\Traits;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

const secondary = 'secondary';

trait DBSecondary
{
    public static function bootDBSecondary()
    {
    }

    public function db(): Connection
    {
        return DB::connection(env('PMS_DB', 'pms'));
    }

    public function table($tableName): Builder
    {
        return $this->db()->table($tableName);
    }

    public function query($tableName, $columns = "*"): Builder
    {
        return $this->table($tableName)->select($columns);
    }

    public function findById($tableName, $id, $columns = "*"): ?object
    {
        return $this->table($tableName)->select($columns)->where("id", $id)->first();
    }

    public function insert($tableName, $data): bool
    {
        return $this->table($tableName)->insert($data);
    }

    public function updateWhereId($tableName, $id, $data): int
    {
        return $this->table($tableName)->where("id", $id)->update($data);
    }

    public function deleteWhereId($tableName, $id)
    {
        return $this->table($tableName)->where("id", $id)->delete();
    }
}
