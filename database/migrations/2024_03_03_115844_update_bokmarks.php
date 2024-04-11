<?php

use App\Models\Ayat;
use App\Models\Doa;
use App\Models\Hadist;
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
        //
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->foreignIdFor(Hadist::class,"hadist_id")->nullable()->references('id')->on('hadists');
            $table->foreignIdFor(Doa::class,"doa_id")->nullable()->references('id')->on('doas');
            $table->foreignIdFor(Ayat::class,"ayat_id")->nullable()->references('id')->on('ayats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->dropColumn('hadist_id');
            $table->dropColumn('doa_id');
            $table->dropColumn('ayat_id');
        });
    }
};
