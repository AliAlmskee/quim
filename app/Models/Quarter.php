<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
    ];
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
