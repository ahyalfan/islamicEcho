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
        // tahlil
        Schema::create('tahlils', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('tahlil');
            $table->integer('no');
            $table->string('judul');
            $table->text('latin')->nullable(); //kits ksdih nullsbrl karena belum nemu resourcenya
            $table->text('arab');
            $table->text('indo');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahlils');
    }
};
