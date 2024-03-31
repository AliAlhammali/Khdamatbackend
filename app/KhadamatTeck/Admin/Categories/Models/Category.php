<?php

namespace App\KhadamatTeck\Admin\Categories\Models;

use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends BaseModel
{
    use HasTranslations;

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

    protected $fillable = ['id', 'title', 'slug', 'status', 'merchant_id'];

    public array $translatable = ['title', 'slug'];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function scopeMerchantCategories($query, $merchant_id)
    {
        return $query->where(function ($query) use ($merchant_id) {
            $query->whereNull('merchant_id')->orWhere('merchant_id', $merchant_id);
        });
    }
}