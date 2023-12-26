<?php

namespace Tests\Feature\http\controllers;

use App\Models\Admin;
use App\Services\GenerateToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashProductControllerTest extends TestCase
{

    //    public function test_example(): void
    //    {
    //        $response = $this->get('/');
    //
    //        $response->assertStatus(200);
    //    }

    public function test_show_create_product_view()
    {
        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();
        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        $response = $this->get(route('admin.product.create.basic'));
        $response->assertViewIs('dash.product.create.create_basic');
    }

    public function test_add_new_product()
    {
        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();
        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        $response = $this->post(route('admin.product.store.basic'),
            [
            'brand_id' => 1,
            'is_active' => 0,
            'admin_id' => $admin->id,
            'title_english' => 'product_english',
            'title_persian' => 'محصول جدید',
            'sku' =>'product_english',
            'product_tags' => "product,new_product",
            'short_description' => 'توضیحات',
            'full_description' => 'توضیحات',
            'seo_desc' => 'توضیحات',
            'origin_price' => '1000',
            'published_at' => Carbon::now()->timestamp,
            'weight' => 20,
            'length' => 20,
            'width' => 20,
            'height' => 20,
            'available_in_stock' => 50,
            'marketable' => 1,
            'categories' => ['0'=>'1','1'=>'2'],
        ]);
        $response->assertRedirectToRoute('admin.product.index');
    }

    public function test_edit_product()
    {
        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();
        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        $response = $this->post(route('admin.product.update.basic'),
            [
                'product' => 8,
                'brand_id' => 1,
                'is_active' => 0,
                'admin_id' => $admin->id,
                'title_english' => 'product_english',
                'title_persian' => 'ویرایش محصول جدید',
                'sku' =>'product_english',
                'product_tags' => "product edited ,new_product edited",
                'short_description' => 'ویرایش توضیحات',
                'full_description' => ' ویرایش توضیحات',
                'seo_desc' => 'ویرایش توضیحات',
                'origin_price' => '2000',
                'published_at' => Carbon::now()->timestamp,
                'weight' => 20,
                'length' => 20,
                'width' => 20,
                'height' => 20,
                'available_in_stock' => 50,
                'marketable' => 1,
                'categories' => ['0'=>'1','1'=>'2'],
            ]);
        $response->assertRedirectToRoute('admin.product.index');



    }
}
