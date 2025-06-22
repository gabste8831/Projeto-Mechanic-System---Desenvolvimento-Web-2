<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'license_plate',
        'color',
        'problem_description',
        'status',
        'mechanic_id'
    ];

    protected $casts = [
        'year' => 'integer'
    ];

    public function mechanic(): BelongsTo
    {
        return $this->belongsTo(Mechanic::class);
    }
}
