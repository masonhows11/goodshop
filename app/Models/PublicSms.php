<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicSms extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'public_sms';
    protected $fillable = ['title','body','published_at'];
}
