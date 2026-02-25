<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'featured',
        'height',
        'width',
        'release_date',
        'collection_id'
    ];

    protected $casts = [
        'featured'     => 'boolean',
        'release_date' => 'datetime'
    ];

    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------

    // Relación: un producto pertenece a una colección
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    // Relación: un producto tiene muchas imágenes
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Relación: un producto tiene una imágen principal
    public function mainImage()
    {
        return $this->hasOne(Image::class)->where('is_main', true);
    }

    // Relación: un producto tiene muchas reviews(reseñas)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relación: un producto tiene muchos detalles de pedido
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Relación: un producto tiene muchos items de carrito
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
