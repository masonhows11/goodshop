<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory,HasRecursiveRelationships,HasPersianSlug;

    protected $table = 'categories';
    protected $fillable = ['title_english',
                          'title_persian',
                          'image_path',
                          'show_in_menu',
                          'tags',
                          'slug',
                          'icon',
                          'status',
                          'parent_id'];

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_english')
            ->saveSlugsTo('slug');
    }
    public function getParentKeyName()
    {
        return 'parent_id';
    }
    public function parent(){

        return $this->belongsTo(Category::class,'parent_id')->with('parent');
    }
    public function child()
    {
        return $this->HasMany(Category::class,'parent_id')->with('child');
    }

    public static function getParent($parent_id)
    {
        return  self::where('id',$parent_id)->first();
    }

    // for many to many with products table
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
           // ->orderby('created_at','ASC');
    }

    // for many to many with brand model
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    // for one to many category attribute
    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

}
