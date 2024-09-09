<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
        'order',
    ];

    public function books(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    public function audios(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Audio::class);
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

}
