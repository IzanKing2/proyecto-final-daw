<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Clase que representa un item de carrito
 * @package App\Models
 */
class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $fillable = [
        'quantity',
        'cart_id',
        'product_id'
    ];

    // ——————————————————————————————————————————————————————————————————
    // RELACIONES
    // ——————————————————————————————————————————————————————————————————
    
    // Relación: un cartItem(item de carrito) pertenece a una carrito
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relación: un cartItem(item de carrito) pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
