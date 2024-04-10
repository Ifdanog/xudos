<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemwallets extends Model
{
    public $table = 'system_wallets';
protected $fillable = [
    'store_id',
    'wallet',
    'private_key',
    'chain',
    'balance',
    'sol_usdt'
];
protected $hidden = [
    'private_key',
];
}
