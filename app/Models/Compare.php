<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compare extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'compares';
    protected $fillable = ['user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // many to many with  Product model
    public function products()
    {
        return
            $this->belongsToMany(Product::class,'compare_product');
    }
}
