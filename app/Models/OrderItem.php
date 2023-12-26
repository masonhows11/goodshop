<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  OrderItem extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_items';
    protected  $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'amazing_sale_id',
        'product_color_id',
        'guarantee_id',
        'number',
        'amazing_sale_discount_amount',
        'final_product_price',
        'final_total_price'
    ];

    public function product(){

        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function singleProduct(){

        return $this->belongsTo(Product::class,'product_id');
    }

    public function amazingSale(){

        return $this->belongsTo(AmazingSales::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class,'product_color_id');
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }

    public function orderItemAttribute()
    {
        return $this->hasMany(OrderItemSelectedAttribute::class);
    }

}
