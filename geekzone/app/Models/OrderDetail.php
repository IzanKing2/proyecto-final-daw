<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'quantity',
        'price_at_purchase',
        'order_id',
        'product_id'
    ];

    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------
    
    // Relación: un orderDetail(detalle de pedido) pertenece a un order(pedido)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relación: un orderDetail(detalle de pedido) pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
