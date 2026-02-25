<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ----------------------------------------------------------------
    // RELACIONES
    // ----------------------------------------------------------------

    // Relación: un usuario pertenece a un rol
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relación: un usuario tiene muchos orders(pedidos)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relación: un usuario tiene muchas reviews(reseñas)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relación: un usuario tiene un único carrito
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // ----------------------------------------------------------------
    // MÉTODOS REQUERIDOS POR JWTSubject
    // ----------------------------------------------------------------
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // ----------------------------------------------------------------
    // MÉTODOS HELPER
    // ----------------------------------------------------------------
    public function isAdmin()
    {
        return $this->role->name === 'Admin';
    }
}
