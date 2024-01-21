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
        Schema::create('valoration', function (Blueprint $table) {
            $table->id('idValoration');
            $table->float('score', 2, 1);
            $table->string('commentary');
            $table->integer('idPerson')->references('id')->on('users');
            $table->integer('idBooking')->references('idBooking')->on('booking');;

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
        Schema::dropIfExists('valoration');
    }
};
