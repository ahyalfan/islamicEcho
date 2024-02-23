<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AudioAyat extends Model
{
    use HasFactory;
    protected $fillable = [
        "ayat_id",
        "qori_name",
        "path_audio",
        "slug",
    ];

    // ayat
    public function ayat():BelongsTo
    {
        return $this->belongsTo(Ayat::class,'ayat_id','id');
    }
}
