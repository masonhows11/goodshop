<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'guarantees';

    protected $fillable = [
        'guarantee_name',
        'product_id',
        'price_increase',
        'status'
    ];

    public function product(){

        return $this->belongsTo(Product::class);
    }

}
