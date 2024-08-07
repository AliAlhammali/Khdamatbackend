<?php

namespace App\KhadamatTeck\Admin\Categories\Models;

use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Category extends BaseModel
{
    use NodeTrait;
    use HasTranslations;
    use HasTranslatableSlug;

    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'title', 'slug', 'status', 'merchant_id', 'parent_id'];

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('parent_id'),
            AllowedFilter::exact('main_category_id', 'parent_id'),
            AllowedFilter::exact('status'),
            AllowedFilter::exact('merchant_id'),
            AllowedFilter::exact('status'),
            AllowedFilter::scope('isParent', 'isParent'),
            AllowedFilter::custom('keyword', new KeywordSearchFilter(['title'])),
        ];
    }

    public array $translatable = ['title', 'slug'];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function services()
    {
        return $this->hasMany(ServiceModel::class);
    }


    public function scopeMerchantCategories($query, $merchant_id)
    {
        return $query->where(function ($query) use ($merchant_id) {
            $query->whereNull('merchant_id')->orWhere('merchant_id', $merchant_id);
        });
    }

    public function isParent()
    {
        return $this->parent_id == null;
    }


    public function scopeIsParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(['en', 'ar'])
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
