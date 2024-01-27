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
        Schema::create('housing', function (Blueprint $table) {
            $table->id('idHousing');
            $table->date('initial_date');
            $table->date('final_date');
            $table->date('arrival_date');
            $table->integer('total_person');
            $table->integer('idPerson')->references('id')->on('users');
            $table->integer('idBooking')->references('idBooking')->on('booking');

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
        Schema::dropIfExists('housing');
    }
};
