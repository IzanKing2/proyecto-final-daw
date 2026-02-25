<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id'
    ];

    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------
    
    // Relación: un carrito pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: un carrito tiene muchos cartItems(items de carrito)
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
