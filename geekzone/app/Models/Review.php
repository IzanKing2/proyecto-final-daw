<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'product_id'
    ];

    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------
    
    // Relación: una review(reseña) pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: una review pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
