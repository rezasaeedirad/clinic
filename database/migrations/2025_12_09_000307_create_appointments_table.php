<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // ارتباط با جدول doctors
            $table->foreignId('doctor_id')
                  ->constrained('doctors')
                  ->onDelete('cascade');

            // ارتباط با جدول users (بیمار)
            $table->foreignId('patient_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // زمان نوبت
            $table->dateTime('appointment_at');

            // وضعیت نوبت: pending, confirmed, completed, cancelled
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
