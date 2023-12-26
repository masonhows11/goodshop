<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function PHPUnit\Framework\returnCallback;

class CartItems extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'cart_items';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_color_id',
        'guarantee_id',
        'number'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class,'product_color_id');
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class,'guarantee_id');
    }


    // price : product price + color price + warranty price * number of each item
    // price of each product multiplied by the number of that product
    public function cartItemProductPrice()
    {

        $warrantyPrice = empty($this->guarantee_id) ? 0 : $this->warranty->price_increase;
        $colorPrice = empty($this->product_color_id) ? 0 : $this->color->price_increase;
        return ($this->product->origin_price + $warrantyPrice + $colorPrice ) * $this->number;
    }

    // price of item in cart = product price + color price + warranty price
    // without number of each item
    public function cartItemProductPriceWithOutNumber()
    {
        $warrantyPrice = empty($this->guarantee_id) ? 0 : $this->warranty->price_increase;
        $colorPrice = empty($this->product_color_id) ? 0 : $this->color->price_increase;
        return $this->product->origin_price + $warrantyPrice + $colorPrice ;
    }

    // calculate discount for each product : product price * (discount / 100)
    // discount an amazing sales
    public function cartItemProductDiscount()
    {
        $cart_item_product_price = $this->cartItemProductPriceWithOutNumber();
        $productDiscount = empty($this->product->activeAmazingSale()) ? 0 : $cart_item_product_price * ($this->product->activeAmazingSale()->percentage / 100);
        return    $productDiscount;
    }

    // number of each * price product ( productPrice + colorPrice + warrantyPrice - discountPrice )
    public function cartItemFinalPrice()
    {
        $cart_item_product_price = $this->cartItemProductPriceWithOutNumber();
        $product_discount = $this->cartItemProductDiscount();
        return $this->number * ($cart_item_product_price - $product_discount);
    }

    // number - productDiscount
    public function cartItemFinalDiscount(){

        $productDiscount = $this->cartItemProductDiscount();
        return $this->mumber * $productDiscount;

    }

}
