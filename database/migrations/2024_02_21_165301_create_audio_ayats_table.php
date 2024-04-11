<?php

use App\Models\Ayat;
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
        // audio ayat
        Schema::create('audio_ayats', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('audio');
            $table->foreignIdFor(Ayat::class,"ayat_id")->references('id')->on('ayats');
            $table->string("qori_name")->default("");//berisi yg mensuarkan audionya
            $table->string("path_audio")->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_ayats');
    }
};
