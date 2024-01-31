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
        Schema::create('booking_gallerys', function (Blueprint $table) {
            $table->id('idBooking_gallery');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('idBooking');
            $table->foreign('idBooking')->references('idBooking')->on('bookings'); // Ajusta según el nombre real de tu tabla de categorías
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_gallerys');
    }
};
