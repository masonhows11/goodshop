<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory,HasPersianSlug;
    protected $table='tags';
    protected $fillable = ['title_persian','title_english'];

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_english')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
