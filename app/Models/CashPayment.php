<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashPayment extends Model
{
    use HasFactory;
    protected $table = 'cash_payments';
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'cash_receiver',
        'pay_date',
        'status'
    ];

    public function payments()
    {
        return $this->morphMany('App\Models\Payment','paymentable');
    }
}
