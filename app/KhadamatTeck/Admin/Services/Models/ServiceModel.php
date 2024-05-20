<?php

namespace App\KhadamatTeck\Admin\Services\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Base\Filters\KeywordSearchFilter;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ServiceModel extends BaseModel
{
    use HasTranslations, HasTranslatableSlug;

    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'title',
        'price',
        'cost_price',
        'sp_price',
        'slug',
        'description',
        'status',
        'merchant_id',
        'category_id',
        'main_category_id'
    ];

    public static function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('merchant_id'),
            AllowedFilter::exact('category_id'),
            AllowedFilter::exact('main_category_id'),
            AllowedFilter::exact('status'),
            AllowedFilter::custom('keyword', new KeywordSearchFilter(['title'])),
        ];
    }
    public array $translatable = ['title', 'slug'];

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function mainCategory()
    {
        return $this->belongsTo(Category::class, 'main_category_id');
    }

    function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function scopeMerchantCategories($query, $merchant_id)
    {
        return $query->where(function ($query) use ($merchant_id) {
            $query->whereNull('merchant_id')->orWhere('merchant_id', $merchant_id);
        });
    }



    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(['en', 'ar'])
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
