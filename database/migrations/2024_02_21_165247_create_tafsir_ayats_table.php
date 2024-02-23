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
        // tafsir
        Schema::create('tafsir_ayats', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('tafsir');
            $table->foreignIdFor(Ayat::class,"ayat_id");
            $table->string("jenis_tafsir")->default("");//berisi wajiz atau tahlili
            $table->text("description")->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tafsir_ayats');
    }
};
