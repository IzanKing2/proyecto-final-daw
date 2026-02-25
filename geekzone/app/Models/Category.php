<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------
    
    // Relación: a una categoría le pertenecen muchas colecciones
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'category_collection');
    }
}
