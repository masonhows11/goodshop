<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingSales extends Model
{
    use HasFactory,SoftDeletes;
    protected  $table = 'amazing_sales';
    protected $fillable = [
        'product_id',
        'percentage',
        'status',
        'start_date',
        'end_date'
    ];


    public function product(){

        return $this->belongsTo(Product::class);

    }
}
