<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainSlider extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'main_sliders';
    protected $fillable = [
        'title',
        'image_path',
        'url',
        'status'
    ];
}
