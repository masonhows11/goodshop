<?php

namespace App\Models;

use App\Http\Controllers\Dash\AdminCityController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'provinces';
    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class,'city_id');
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
