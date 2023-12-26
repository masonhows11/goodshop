<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    use HasFactory;
    protected $table = 'online_payments';
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'gateway',
        'transaction_id',
        'bank_first_response',
        'bank_second_response',
        'status'
    ];

    public function payments()
    {
        return $this->morphMany('App\Models\Payment','paymentable');
    }
}
