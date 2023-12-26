<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Nagy\LaravelRating\Traits\Rateable;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasPersianSlug, SoftDeletes ,Rateable;

    protected $table = 'products';
    protected $fillable = [
        'user_id',
        'brand_id',
        'title_english',
        'title_persian',
        'slug',
        'sku',
        'short_description',
        'full_description',
        'thumbnail_image',
        'status',
        'tags',
        'weight',
        'length',
        'width',
        'height',
        'origin_price',
        'marketable',
        'number_sold',
        'frozen_number',
        'salable_quantity',
        'available_in_stock',
        'published_at',
        'seo_desc',
    ];


    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_english')
            ->saveSlugsTo('slug');
    }

    // for many to many with categories table
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    // relation with brand table / model
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    // relation with productImage table / model
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    // relation with rates table / model
    public function rates()
    {
        return $this->hasMany(ProductRate::class, 'product_id');
    }

    // relation with comments table / model
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function meta()
    {

        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    // 1 to n with CategoryAttributeValue model
    public function values()
    {
        return $this->hasMany(CategoryAttributeValue::class);
    }

    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()
                ->where('id', 'like', '%' . $search . '%')
                ->orWhere('title_persian', 'like', '%' . $search . '%')
                ->orWhere('title_english', 'like', '%' . $search . '%');
    }

    // 1 to n with warranty  model
    public function warranties()
    {
        return $this->hasMany(Warranty::class);
    }

    // 1 to n with amazing sales model
    public function amazingSales()
    {
        return $this->hasMany(AmazingSales::class);
    }

    // get active amazing sales by date model
    public function activeAmazingSale()
    {
        return $this->amazingSales()
            ->where('start_date', '<', Carbon::now())
            ->where('end_date', '>', Carbon::now())
            ->first();
    }

    public function AmazingSaleOnOriginPrice()
    {

        return $this->origin_price - ($this->origin_price * ($this->activeAmazingSale()->percentage / 100));
    }

    public function AmazingSaleOnDefaultColorPrice($price)
    {
        return $price - ($price * ($this->activeAmazingSale()->percentage / 100));
    }

    public function AmazingSaleOnChangeColorPrice($price)
    {
        return $price - ($price * ($this->activeAmazingSale()->percentage / 100));
    }

    // one product belongs to many  users
    public function user()
    {
        return $this->belongsToMany(User::class,'product_user');
    }

    // many to many with  Compare model
    public function compares()
    {
        return
            $this->belongsToMany(Compare::class,'compare_product');
    }

}
