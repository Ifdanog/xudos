<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $fillable = [
        'user_id',
        'wallet',
        'private_key',
        'chain',
        'balance'
    ];
    protected $hidden = [
        'private_key',
    ];
}
