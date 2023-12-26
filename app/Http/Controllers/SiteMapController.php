<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

class SiteMapController extends Controller
{
    //
    public function index()
    {
        return response()
            ->view('sitemap.index')
            ->header('Content-Type', 'text/xml');
    }

    public function static(){
        return response()
            ->view('sitemap.static')
            ->header('Content-Type', 'text/xml');
    }

    public function categories(){
        $categories = Category::all();
        return response()
            ->view('sitemap.categories', [ 'categories' => $categories ])
            ->header('Content-Type', 'text/xml');
    }

    public function products(){

        $products = Product::latest()->get();
        return response()
            ->view('sitemap.products', [ 'products' => $products ])
            ->header('Content-Type', 'text/xml');

    }

    public function tags(){
        $tags = Tag::all();
        return response()
            ->view('sitemap.tags', ['tags' => $tags])
            ->header('Content-Type', 'text/xml');
    }

}
