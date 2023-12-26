<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'user_id',
        'order_number',
        'address_id',
        'payment_id',
        'delivery_id',
        'coupon_id',
        'common_discount_id',

        'order_final_amount',
        'order_discount_amount',
        'order_coupon_discount_amount',
        'order_common_discount_amount',
        'order_total_products_discount_amount',
        'delivery_amount',

        'delivery_date',
        'payment_type',

        'payment_status',
        'order_status',
        'delivery_status',
    ];

    public function cashPayment(){

        return $this->hasOne(CashPayment::class);
    }


    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction(){
        return $this->hasOne(Transaction::class,'order_id');
    }

    public function getPaymentStatusValueAttribute()
    {
        switch ($this->payment_status) {
            case 0:
                $result = __('messages.unpaid');
                break;
            case 1:
                $result = __('messages.paid');
                break;
            case 2:
                $result = __('messages.pay_returned');
                break;
            default:
                $result = __('messages.unpaid');

        }

        return $result;
    }
    public function getPaymentTypeValueAttribute()
    {
        switch ($this->payment_type) {
            case 0:
                $result = __('messages.online_pay');
                break;
            case 1:
                $result = __('messages.offline_pay');
                break;
            case 2:
                $result = __('messages.payment_on_the_spot');
                break;
            default:
                $result = __('messages.payment_on_the_spot');
        }
        return $result;
    }

    public function getDeliveryStatusValueAttribute()
    {
        switch ($this->delivery_status) {
            case 0:
                $result = __('messages.order_not_sent');
                break;
            case 1:
                $result = __('messages.order_sending');
                break;
            case 2:
                $result = __('messages.order_sent');
                break;
            case 3:
                $result = __('messages.order_delivered');
                break;
        }
        return $result;
    }

    public function getOrderStatusValueAttribute()
    {
        switch ($this->order_status) {
            case 0:
                $result = __('messages.order_wait_for_confirmed');
                break;
            case 1:
                $result = __('messages.order_not_confirmed');
                break;
            case 2:
                $result = __('messages.order_confirmed');
                break;
            case 3:
                $result = __('messages.order_returned');
                break;
            case 4:
                $result = __('messages.order_canceled');
                break;
        }
        return $result;
    }

}
