<?php

namespace Tests\Feature\http\controllers;

use App\Models\Admin;
use App\Services\GenerateToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashProfileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_show_profile_view_dont_login(): void
    {

        $response = $this->get(route('admin.profile'));
        $response->assertStatus(302);

    }

    public function test_show_profile_does_login()
    {
        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();
        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );
        $response = $this->get(route('admin.profile'));
        $response->assertViewIs('auth_admin.profile.profile');
    }

    public function test_profile_update_dont_login()
    {
        $response = $this->post(route('admin.update.profile', [
            'name' => 'ggg',
            'first_name' => 'hhhh',
            'last_name' => 'hhhhhggg',
            'email' => 'mason.hows11@gmail.com',
        ]));
        $response->assertRedirectToRoute('admin.login');
    }

    public function test_profile_update_does_login()
    {

        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email','mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();
        $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );
        $response = $this->post(route('admin.update.profile', [
            'id' => $admin->id,
            'name' => 'naeem1991',
            'first_name' => 'naeem',
            'last_name' => 'soltany',
            'email' => 'mason.hows11@gmail.com',
        ]));
        $response->assertRedirectToRoute('admin.profile');
    }
}
