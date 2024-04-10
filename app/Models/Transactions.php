<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    public $table = 'Transactions';
    protected $fillable = [
        'to',
        'date',
        'description',
        'amount',
        'fee',
        'chain',
        'user_id',
        'created_at'
    ];

}
