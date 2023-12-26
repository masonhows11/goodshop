<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttributeValue extends Model
{
    use HasFactory,SoftDeletes;
    protected $table  = 'category_values';
    protected $fillable = [
        'product_id',
        'category_attribute_id',
        'value',
        'price_increase',
        'type',
    ];


    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class,'category_attribute_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
