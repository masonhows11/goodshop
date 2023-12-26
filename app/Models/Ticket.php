<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tickets';
    protected $fillable = [
        'subject','description','status','seen','reference_id','user_id','category_id','priority_id','ticket_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class,'reference_id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function parent()
    {
        return $this->belongsTo(Ticket::class,'ticket_id')
            ->with('parent');
    }

    public function child()
    {
        return $this->hasMany(Ticket::class,'ticket_id')
            ->with('child');
    }

    public function file()
    {
        return $this->hasOne(TicketFile::class);
    }
}
