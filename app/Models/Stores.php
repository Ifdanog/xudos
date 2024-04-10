<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Stores extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'stowner_id',
        'name',
        'store_type',
        'email',
        'mobile',
        'valid_till',
        'profit_percentage'
    ];

    public function wallets()
    {
        return $this->hasMany(SystemWallets::class, 'store_id');
    }
    public function cashiers()
    {
        return $this->hasMany(Cashier::class, 'store_id');
    }
}
