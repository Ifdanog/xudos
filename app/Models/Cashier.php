<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashier extends Model
{
    use SoftDeletes;
    public $table = 'cashiers';
    protected $fillable = [
        'store_id',
        'cashier_id',
    ];
    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'cashier_id');
    }
}
