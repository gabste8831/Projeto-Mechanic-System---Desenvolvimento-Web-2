<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mechanic extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialty',
        'experience_years',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'experience_years' => 'integer'
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
