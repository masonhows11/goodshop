<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingOfferBanner extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'amazing_offer_banners';
    protected $fillable = [
        'title',
        'image_path',
        'url',
        'status'
    ];
}
