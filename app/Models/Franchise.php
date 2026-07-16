<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Franchise extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function series(): HasMany
    {
        return $this->hasMany(Series::class);
    }
}