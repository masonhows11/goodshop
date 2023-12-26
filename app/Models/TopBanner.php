<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopBanner extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'top_banners';
    protected $fillable = [
        'title',
        'image_path',
        'url',
        'status'
    ];
}
