<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'iban',
        'street',
        'zip',
        'country',
        'city',
        'contract_start_date',
        'membership_payment',
        'monthly_payment',
        'security_benefit',
        'company_id',
        'user_id',
        'contract_no',
        'is_active'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
