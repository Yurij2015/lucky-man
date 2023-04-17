<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public ?string $username = null;
    public ?string $phone = null;
    protected $fillable = [
        'username', 'phone'
    ];
}
