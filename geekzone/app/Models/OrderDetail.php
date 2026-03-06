<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que representa un detalle de pedido
 * @package App\Models
 */
class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'quantity',
        'price_at_purchase',
        'order_id',
        'product_id'
    ];

    // ——————————————————————————————————————————————————————————————————
    // RELACIONES
    // ——————————————————————————————————————————————————————————————————
    
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
