<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // One-to-One Relationship
    public function profile(): HasOne
    {
        return $this->hasOne(PatientProfile::class);
    }

    // One-to-Many Relationship
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
