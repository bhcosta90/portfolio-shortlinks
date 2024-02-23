<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShortLink extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'url',
        'hash',
        'date_expired_at',
        'total',
        'created_at',
    ];

    protected $casts = [
        'date_expired_at' => 'datetime',
        'total' => 'integer',
    ];

    public function click(): HasMany
    {
        return $this->hasMany(ClickShortLink::class);
    }
}
