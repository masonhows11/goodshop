<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflinePayment extends Model
{
    use HasFactory;
    protected  $table = 'offline_payments';
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'gateway',
        'transaction_id',
        'bank_first_response',
        'pay_date',
        'status'
    ];

    public function payments()
    {
        return $this->morphMany('App\Models\Payment','paymentable');
    }
}
