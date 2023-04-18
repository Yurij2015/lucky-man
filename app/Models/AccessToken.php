<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id', 'token', 'token_validity_period', 'status'
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
