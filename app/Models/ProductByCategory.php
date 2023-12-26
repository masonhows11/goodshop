<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductByCategory extends Model
{
    use HasFactory;
    protected $table = 'product_by_categories';
    protected $fillable = [
        'category_id',
        'category_name',
        'description'
    ];
}
