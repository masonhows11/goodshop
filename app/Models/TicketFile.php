<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketFile extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'ticket_files';
    protected $fillable = [
        'file_path',
        'file_size',
        'file_type',
        'status',
        'user_id',
        'ticket_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

}
