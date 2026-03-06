<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase que representa una imagen
 * @package App\Models
 */
class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'url_path',
        'is_main',
        'product_id'
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];

    // ——————————————————————————————————————————————————————————————————
    // RELACIONES
    // ——————————————————————————————————————————————————————————————————
    
    // Relación: una imagen pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
