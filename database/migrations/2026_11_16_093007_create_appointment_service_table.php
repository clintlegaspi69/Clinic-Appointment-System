<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_service', function (Blueprint $table) {
            $table->id();

            // Foreign key for Appointment
            $table->foreignId('appointment_id')
                  ->constrained('appointments')
                  ->cascadeOnDelete();

            // Foreign key for Service
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->cascadeOnDelete();

            // Prevent duplicate services in one appointment
            $table->unique(['appointment_id', 'service_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_service');
    }
};
