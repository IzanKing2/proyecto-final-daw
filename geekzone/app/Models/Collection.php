<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'name'
    ];

    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------
    
    // Relación: una colección tiene muchos productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relación: una collección pertenece a una o muchas categorías
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_collection');
    }
}
