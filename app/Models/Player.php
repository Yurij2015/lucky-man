<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'phone'
    ];

    public function accessToken(): HasMany
    {
        return $this->hasMany(AccessToken::class);
    }

    public function playerPoints(): HasMany
    {
        return $this->hasMany(PlayerPoints::class);
    }
}
