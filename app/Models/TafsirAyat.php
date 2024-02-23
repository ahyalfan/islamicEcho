<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TafsirAyat extends Model
{
    use HasFactory;

    protected $fillable = [
        "ayat_id",
        "jenis_tafsir",
        "description",
        "slug",
    ];

    // ayat
    public function ayat():BelongsTo
    {
        return $this->belongsTo(Ayat::class,'ayat_id','id');
    }
}
