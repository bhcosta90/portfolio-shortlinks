<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClickShortLink extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'created_at',
        'ip'
    ];
}
