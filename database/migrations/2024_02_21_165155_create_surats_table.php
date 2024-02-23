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
        // surat
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('surat');
            $table->integer('nomer_surah')->default(0);
            $table->integer('jum_ayat');
            $table->string('indo');
            $table->string('arab');
            $table->string('arti');
            $table->string('golongan');
            $table->string('audio_full')->nullable();
            $table->text('description');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
