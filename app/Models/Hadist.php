<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hadist extends Model
{
    use HasFactory;

    protected $fillable = [
        "hadist_collection_id",
        "arab",
        "indo",
        "nomer",
        "slug",
    ];

    public function hadistCollection():BelongsTo
    {
        return $this->belongsTo(HadistCollection::class,'hadist_collection_id');
    }

    // bookmark
    public function bookmark():HasMany
    {
        return $this->hasMany(Bookmark::class,'hadist_id','id');
    }
}
