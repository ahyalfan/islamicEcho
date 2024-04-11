<?php

use App\Models\CategoryDoa;
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
        // doa list
        Schema::create('doas', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('doa');
            $table->foreignIdFor(CategoryDoa::class,'category_id')->references('id')->on('category_doas');
            $table->string('title')->nullable(false);
            $table->text('indo');
            $table->text('arab');
            $table->text('latin');
            $table->string('notes')->nullable();
            $table->text('fawaid')->nullable();
            $table->string('src')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doas');
    }
};
