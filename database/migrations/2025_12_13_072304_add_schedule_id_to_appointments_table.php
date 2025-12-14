<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // اضافه کردن ارتباط با جدول schedules
            $table->foreignId('schedule_id')
                  ->after('doctor_id')
                  ->constrained('schedules')
                  ->cascadeOnDelete();

            // اضافه کردن ستون appointment_date
            $table->date('appointment_date')->after('schedule_id');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // حذف ستون و رابطه
            $table->dropForeign(['schedule_id']);
            $table->dropColumn('schedule_id');

            // حذف ستون تاریخ نوبت
            $table->dropColumn('appointment_date');
        });
    }
};
