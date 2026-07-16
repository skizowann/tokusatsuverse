<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episode extends Model
{
    protected $fillable = ['series_id', 'episode_number', 'title', 'synopsis', 'duration'];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }
}