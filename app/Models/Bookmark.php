<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "content_type",
        "content_id",
        "ayat_id",
        "hadist_id",
        "doa_id",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }

    // one to one
    public function ayat(): BelongsTo
    {
        return $this->belongsTo(Ayat::class,"ayat_id");
    }
    public function hadist(): BelongsTo
    {
        return $this->belongsTo(Hadist::class,"hadist_id");
    }
    public function doa(): BelongsTo
    {
        return $this->belongsTo(Doa::class,"doa_id");
    }
}
