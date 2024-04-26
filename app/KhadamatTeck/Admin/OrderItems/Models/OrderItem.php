<?php

namespace App\KhadamatTeck\Admin\OrderItems\Models;

use App\KhadamatTeck\Admin\Services\Models\ServiceModel;
use App\KhadamatTeck\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends BaseModel
{
    protected $with = [
        'item'
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

    protected $fillable = ['id', 'order_id', 'item_id', 'quantity', 'item_price', 'sup_total', 'vat', 'total', 'order_otp'];

    function item(): BelongsTo
    {
        $belongs = $this->belongsTo(ServiceModel::class,'item_id');
        if(request('includeOrderItemService')){
            $belongs->with([
                'item.category'
            ]) ;
        }
        return $belongs;
    }
}
