<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'cities';
    protected $fillable = ['province_id','name'];


    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }


    public  function create($province,$name){

        $this->name = $name;
        $this->province_id = $province;
        $this->save();

    }


    public  function updateModel($name){

        $this->name = $name;
        $this->save();

    }


}
