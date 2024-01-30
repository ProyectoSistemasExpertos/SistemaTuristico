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
        Schema::create('housings', function (Blueprint $table) {
            $table->id('idHousing');
            $table->date('initial_date');
            $table->date('final_date');
            $table->date('arrival_date');
            $table->integer('total_person');
            $table->unsignedBigInteger('idPerson');
            $table->foreign('idPerson')->references('id')->on('users'); // Ajusta según el nombre real de tu tabla de categorías
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
        Schema::dropIfExists('housings');
    }
};
