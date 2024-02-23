<?php

use App\Models\HadistCollection;
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
        // list hadist
        Schema::create('hadists', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('hadist');
            $table->foreignIdFor(HadistCollection::class,'hadist_collection_id');
            $table->integer('nomer')->nullable();
            $table->text('arab')->default('');
            $table->text('indo')->default('');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadists');
    }
};
