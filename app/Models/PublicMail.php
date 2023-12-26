<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicMail extends Model
{

    use HasFactory,SoftDeletes;
    protected $table = 'public_mail';
    protected $fillable = ['subject','body','published_at'];

    public function files()
    {
        return $this->hasMany(PublicMailFile::class,'public_mail_id');
    }
}
