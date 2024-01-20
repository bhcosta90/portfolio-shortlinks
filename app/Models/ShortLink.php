<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShortLink extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [];

    public function shortLinkHistories(): HasMany
    {
        return $this->hasMany(ShortLinkHistory::class);
    }
}
