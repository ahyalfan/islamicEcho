<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ayat extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'nomer_ayat',
        'juz',
        'page',
        'indo',
        'arab',
        'latin',
        'slug',
    ];

    // surat
    public function surat():BelongsTo
    {
        return $this->belongsTo(Surat::class,'surat_id','id');
    }

    // tafsir
    public function tafsir():HasMany
    {
        return $this->hasMany(TafsirAyat::class,'ayat_id','id');
    }

    // audio
    public function audio():HasMany
    {
        return $this->hasMany(AudioAyat::class,'ayat_id','id');
    }

    // bookmark
    public function bookmark():HasMany
    {
        return $this->hasMany(Bookmark::class,'ayat_id','id');
    }
}
