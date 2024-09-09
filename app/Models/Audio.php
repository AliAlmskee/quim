<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
    ];

    public function hadiths(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Hadith::class);
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
