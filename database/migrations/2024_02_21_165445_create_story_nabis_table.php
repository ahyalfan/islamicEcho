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
        // story nabi
        Schema::create('story_nabis', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('story_nabi');
            $table->string('name')->default('');
            $table->integer('thn_kelahiran');
            $table->integer('usia');
            $table->string('tempat');
            $table->text('description');
            $table->string('url_img');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_nabis');
    }
};
