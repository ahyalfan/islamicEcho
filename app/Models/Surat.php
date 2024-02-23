<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Surat extends Model
{
    use HasFactory,HasSlug;

    protected $fillable = [
        'nomer_surah',
        'jum_ayat',
        'indo',
        'arab',
        'arti',
        'golongan',
        'audio_full',
        'description',
        'slug',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('indo')
            ->saveSlugsTo('slug');
    }

    // ayats
    public function ayat():HasMany
    {
        return $this->hasMany(Ayat::class,"surat_id",'id');
    }
}
