<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{

    use HasFactory,SoftDeletes;
    protected $table = 'product_colors';
    protected $fillable = [
        'color_name',
        'color_id',
        'color_code',
        'product_id',
        'sku',
        'price_increase',
        'default',
        'status',
        'available_in_stock',
        'number_sold',
        'frozen_number',
        'salable_quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }


}
