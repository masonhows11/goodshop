<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketAdmin extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'ticket_admins';
    protected $fillable = ['admin_id'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
