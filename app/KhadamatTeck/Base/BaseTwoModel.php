<?php

namespace App\KhadamatTeck\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseTwoModel extends Model implements ModelInterface
{
    protected $keyType = 'int';
    public $incrementing = true;

    /**
     * Override the getIncrementing() function to return false to tell
     * Laravel that the identifier does not auto increment (it's a string).
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return true;
    }

    /**
     * Tell laravel that the key type is a string, not an integer.
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return $this->keyType;
    }

    public static function selector(): BaseDBSelect
    {
        return (new BaseDBSelect());
    }

    public static function getAllowedFilters(): array
    {
        return [];
    }

    public static function getDefaultSort()
    {
        return 'id';
    }

    public static function getAllowedIncludes(): array
    {
        return [];
    }

    public static function getDefaultIncludedRelations(): array
    {
        return [];
    }

    public static function getDefaultIncludedRelationsCount(): array
    {
        return [];
    }

    public static function getAllowedFields(): array
    {
        return [];
    }

    /**
     * Scope a query to only get listing.
     *
     * @param Builder $query
     * @param string[] $data
     *
     * @return Builder
     */
    public function scopeListing(
        Builder $query,
        array   $listFields = ['id', 'title']
    ): Builder
    {
        return $query->select($listFields);
    }
}
