<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Brand extends Model
{
    use HasFactory, HasPersianSlug;

    protected $table = 'brands';
    protected $fillable =
        [
            'title_english',
            'title_persian',
            'is_active',
            'slug',
            'seo_desc',
            'logo_path',
        ];

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_english')
            ->saveSlugsTo('slug');
    }

    // for many to many with type model
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    // relation with product table / model
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
