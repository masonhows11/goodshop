<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemSelectedAttribute extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'order_item_selected_attributes';
    protected $fillable = [];


    public function categoryAttribute()
    {
        return $this->belongsTo(CategoryAttribute::class);
    }

    public function categoryAttributeValue()
    {
        return $this->belongsTo(CategoryAttributeValue::class,'category_value_id');
    }

}
