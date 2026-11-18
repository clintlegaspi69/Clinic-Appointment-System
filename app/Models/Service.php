<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'service_name',
        'price',
    ];

    // Many-to-Many Relationship
    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }
}

