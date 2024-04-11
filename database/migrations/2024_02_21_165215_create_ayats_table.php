<?php

use App\Models\Surat;
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
        // ayat
        Schema::create('ayats', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('ayat');
            $table->foreignIdFor(Surat::class,'surat_id')->references('id')->on('surats');
            $table->integer('nomer_ayat')->default(0);
            $table->integer('juz');
            $table->integer('page'); //ini untuk halaman yg sama kayak alquran asli
            $table->text('indo');
            $table->text('arab');
            $table->text('latin');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayats');
    }
};
