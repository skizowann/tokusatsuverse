<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'videos';

    // Kolom-kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'series_id',
        'title',
        'slug',
        'video_url',
    ];

    /**
     * Relasi ke model Series (Satu Video/Episode dimiliki oleh satu Series)
     */
    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }
}