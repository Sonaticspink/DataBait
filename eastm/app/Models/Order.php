<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'total_price',
        'ordered_at',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id')
            ->with('product');
    }
}
