<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'order_id',
        'payable_price',
        'payable_number',
        'tracking_number',
        'is_paid',
        'authority',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
