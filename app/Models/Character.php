<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Character extends Model
{
    protected $fillable = ['series_id', 'name', 'actor_name', 'description', 'image'];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }
}