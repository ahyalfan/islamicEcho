<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Doa extends Model
{
    use HasFactory,HasSlug;
    protected $fillable = [
        'category_id',
            'title',
            "indo",
            "arab",
            "latin",
            "notes",
            "fawaid",
            "src",
            "slug",
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function categori_doa():BelongsTo
    {
        return $this->belongsTo(CategoryDoa::class,'category_id');
    }
}
