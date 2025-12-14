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
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id'); // شناسه پزشک
            $table->unsignedBigInteger('user_id'); // ارتباط با جدول users
            $table->string('specialty')->nullable(); // تخصص پزشک
            $table->text('bio')->nullable(); // بیوگرافی کوتاه
            $table->string('address')->nullable(); // آدرس مطب
            $table->string('phone', 20)->nullable(); // شماره تماس
            $table->timestamps(); // created_at و updated_at

            // تعریف کلید خارجی برای ارتباط با جدول users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
