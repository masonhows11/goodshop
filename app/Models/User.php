<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Nagy\LaravelRating\Traits\CanRate;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles, CanRate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auth_type',
        'name',
        'first_name',
        'last_name',
        'subscribe_news',
        'national_code',
        'email',
        'mobile',
        'email_verified_at',
        'mobile_verified_at',
        'token',
        'token_guid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function orderItems()
    {
        return $this->hasManyThrough(OrderItem::class,Order::class);
    }


    public function isUserBuyProduct($product_id)
    {
        $product_ids = collect();
        foreach ( $this->orderItems()->where('product_id',$product_id)->get() as $item){
            $product_ids->push($item->product_id);
        }
        $product_ids = $product_ids->unique();
        return $product_ids;

    }
    public function payments(){

        return $this->hasMany(Payment::class);
    }


    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses(){

        return $this->hasMany(Address::class);
    }

    public function products(){

        return $this->belongsToMany(Product::class,'product_user');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function compare(){

        return $this->hasOne(Compare::class);
    }

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

}
