<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    public $table = 'invoices';
    protected $fillable = [
        'cashier_id',
        'payment_id',
        'customer_id',
        'invoice_no'
    ];
}
