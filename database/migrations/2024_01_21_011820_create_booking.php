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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('idBooking');
            $table->string('title');
            $table->string('description');
            $table->boolean('state');
            $table->float('price');
            $table->string('location');
            $table->integer('totalPossibleReservation');
            $table->timestamp('uploadDate')->nullable();
            $table->integer('idPerson')->references('id')->on('users');
            $table->integer('idCategory')->references('idCategory')->on('category');
            

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
        Schema::dropIfExists('booking');
    }
};
