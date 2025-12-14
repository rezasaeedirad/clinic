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
        Schema::table('users', function (Blueprint $table) {
            // اضافه کردن ستون‌ها فقط اگر وجود ندارند
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female'])->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'has_history')) {
                $table->enum('has_history', ['yes', 'no'])->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'history_details')) {
                $table->text('history_details')->nullable()->after('has_history');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'gender', 'has_history', 'history_details']);
        });
    }
};
