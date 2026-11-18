<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientProfile extends Model
{
    protected $fillable = [
        'patient_id',
        'address',
        'date_of_birth',
        'gender',
    ];

    // One-to-One Relationship
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
