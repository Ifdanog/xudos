<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public $table = 'payments';
    protected $fillable = [
        'cashier_id',
        'customer_id',
        'store_id',
        'amount',
        'chain',
        'status',
        'unique_id',
        'created_at'
    ];
    public function cashier()
    {
        return $this->hasOne(User::class, 'id', 'cashier_id');
    }
    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }
    public function Wallets()
    {
        return $this->belongsTo(SystemWallets::class, 'store_id', 'store_id');
    }
}
