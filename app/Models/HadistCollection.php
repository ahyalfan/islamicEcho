<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HadistCollection extends Model
{
    use HasFactory;

    public function hadist():HasMany
    {
        return $this->hasMany(Hadist::class,'hadist_collection_id');
    }
}