<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'company_type',
        'payment_method',
        'iban',
        'employee',
        'valid_till',
        'issued_date',
        'profit_percentage',
        'is_active'
    ];
    public function clients()
    {
        return $this->hasMany(Client::class, 'company_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
