<?php

namespace Tests\Feature\http\controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\Province;
use App\Services\GenerateToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashProvinceControllerTest extends TestCase
{


    public function test_index_province(){
        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();

        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        $response = $this->get(route('admin.province.index'));
        $response->assertViewIs('dash.address_province.index');

    }


    public function test_add_new_province(){

        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();

        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        $response = $this->post(route('admin.province.store'),
            ['name' => 'آذربایجان شرقی']
        );

        $response->assertRedirectToRoute('admin.province.index');
    }


    public function test_add_new_city(){

        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();

        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        $province = Province::create(['name' => 'آذربایجان شرقی']);

        $response = $this->post(route('admin.city.store'),
            ['province' => $province->id ,'name' => 'تبریز']
        );
       // $response->ddHeaders();
        $response->assertRedirectToRoute('admin.city.create',['id' => $province->id]);

    }

    public function test_delete_city()
    {
        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();

        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        //$province = Province::where('id',13)->select('id')->first();
        $city = City::inRandomOrder()->first();
        $province = $city->province_id;
        $response = $this->post(route('admin.city.delete',$city->id),
            ['province' => $province ]
        );
        $response->assertRedirectToRoute('admin.city.create',['id' => $province]);

    }

    public function test_delete_province()
    {
        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();

        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );

        $province = Province::inRandomOrder()->first();
        $response = $this->get(route('admin.province.delete',$province->id));
        $response->assertRedirectToRoute('admin.province.index');

    }





}
