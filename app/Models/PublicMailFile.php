<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicMailFile extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'public_mail_files';
    protected $fillable = ['public_mail_id','file_path','file_size','file_type','status'];

    public function email()
    {
        return $this->belongsTo(PublicMail::class,'public_mail_id');
    }
}
