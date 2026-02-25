<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total_price',
        'shipping_address',
        'payment_method',
        'status',
        'user_id',
        'guest_email'
    ];


    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------
    
    // Relación: un order(pedido) pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: un order(pedido) tiene muchos orderDetail(detalles de pedido)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
