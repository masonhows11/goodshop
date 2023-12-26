<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected  $fillable = [
        'user_id',
        'amount',
        'status',
        'type',
        'paymentable_id',
        'paymentable_type'
    ];



    public function user(){

        return $this->belongsTo(User::class);
    }

    public function paymentable(){

        return $this->morphTo();
    }
}
