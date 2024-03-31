<?php

namespace App\KhadamatTeck\Admin\Services\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Base\BaseModel;
use App\KhadamatTeck\Merchant\Merchants\Models\Merchant;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ServiceModel extends BaseModel
{
    use HasTranslations;

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

    protected $fillable = ['id', 'title','price', 'slug', 'description', 'status', 'merchant_id', 'category_id'];
    public array $translatable = ['title', 'slug'];

    function category()
    {
        $this->belongsTo(Category::class);
    }

    function merchant()
    {
        $this->belongsTo(Merchant::class);
    }
}