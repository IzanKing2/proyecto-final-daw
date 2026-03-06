<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que representa una categoría
 * @package App\Models
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    // ——————————————————————————————————————————————————————————————————
    // RELACIONES
    // ——————————————————————————————————————————————————————————————————
    
    // Relación: a una categoría le pertenecen muchas colecciones
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'category_collection');
    }
}
