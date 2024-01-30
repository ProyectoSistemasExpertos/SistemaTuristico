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
         Schema::create('rol', function (Blueprint $table) {
        $table->id('idRol');
        $table->string('typeRol');

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
        //
    }
};
