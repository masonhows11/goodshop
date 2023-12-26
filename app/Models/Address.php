<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'addresses';
    protected $fillable = [
        'user_id',
        'province_id',
        'mobile',
        'city_id',
        'is_active',
        'plate_number',
        'postal_code',
        'address_description',
        'recipient_first_name',
        'recipient_last_name',
        'coordinate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
