<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'bio',
        'favorite_rider', // Kolom tambahan fans Toku
        'watched_count',  // Kolom tambahan fans Toku
    ];

    /**
     * Relasi ke Series Favorit
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Series::class, 'favorites')->withTimestamps();
    }

    /**
     * Relasi ke Watchlist Series
     */
    public function watchlists(): BelongsToMany
    {
        return $this->belongsToMany(Series::class, 'watchlists')->withPivot('status')->withTimestamps();
    }

    /**
     * Relasi ke Ulasan / Review
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Cek apakah user adalah administrator
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}