<?php

namespace App\KhadamatTeck\Admin\OrderItems\Models;

use App\KhadamatTeck\Admin\Categories\Models\Category;
use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends BaseModel
{
    protected $with = [
        'item','item.category'
    ];
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'order_id', 'item_id', 'quantity','category_id', 'item_price', 'sup_total', 'vat', 'total','sp_item_price', 'sp_sup_total', 'sp_vat', 'sp_total', 'order_otp'];

    function item(): BelongsTo
    {
        return $this->belongsTo(ServiceModel::class,'item_id');
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
