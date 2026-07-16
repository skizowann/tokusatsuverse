<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'series';

    /**
     * Properti Fillable (SUDAH FIXED: Mendaftarkan semua kolom agar bisa disimpan)
     */
    protected $fillable = [
        'title',
        'slug',
        'franchise_id',
        'poster',
        'release_year', // Kolom ini wajib masuk sini agar tidak diblokir Laravel!
        'synopsis',
    ];

    /**
     * Relasi ke model Franchise (Satu Series memiliki Satu Franchise)
     */
    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }

    /**
     * Relasi ke model Genre (Satu Series bisa memiliki Banyak Genre)
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_series', 'series_id', 'genre_id');
    }

    /**
     * Relasi ke model Video / Episode (Satu Series memiliki Banyak Video)
     */
    public function videos()
    {
        return $this->hasMany(Video::class, 'series_id');
    }
}