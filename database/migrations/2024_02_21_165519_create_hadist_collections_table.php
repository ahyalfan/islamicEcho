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
        // periwayat hadist
        Schema::create('hadist_collections', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('hadist_collection');
            $table->string('category_name')->default('');
            $table->string('slug')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadist_collections');
    }
};
