<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'appointment_date',
        'appointment_time',
        'status',
        'reason',
    ];

    // Many-to-One Relationship
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    // Many-to-Many Relationship
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
