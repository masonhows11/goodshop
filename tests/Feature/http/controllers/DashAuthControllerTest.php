<?php

namespace Tests\Feature\http\controllers;

use App\Models\Admin;
use App\Services\GenerateToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashAuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_loginView(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth_admin.login');
    }

    public function test_login_failed()
    {
        $response = $this->post('/admin/login');
        $response->assertStatus(419);

    }

    public function test_login_create_code()
    {

        $response = $this->post(route('admin.login'),
            ['email' => 'mason.hows11@gmail.com']
        );
        $response->assertRedirectToRoute('admin.validate.email.form');
    }

    public function test_login_invalidate()
    {

        $response = $this->post(route('admin.login'),
            ['email' => 'mason.hows15@gmail.com']
        );
        $response->assertStatus(302);
        // for validate error
        $response->assertSessionHasErrors('email');
    }


    public function test_logOut(): void
    {
        $response = $this->get('/admin/logout');

        $response->assertRedirectToRoute('admin.login.form');

    }

    public function test_validateForm()
    {
        $response = $this->get('/admin/validate');
        $response->assertViewIs('auth_admin.validate_email');
    }

    public function test_failed_validateEmail()
    {
        $response = $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows15@gmail.com', 'code' => 781593]
        );
        $response->assertSessionHasErrors('email');

    }

    public function test_failed_login_redirect()
    {
        $response = $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => 781593]
        );
        $response->assertRedirectToRoute('admin.login.form');

    }


    public function test_success_login_admin(){

        $code = GenerateToken::generateAdminToken();
        $admin = Admin::where('email', 'mason.hows11@gmail.com')->first();
        $admin->code = $code;
        $admin->save();
        $response = $this->post(route('admin.validate.email'),
            ['email' => 'mason.hows11@gmail.com', 'code' => $code]
        );
        $response->assertRedirectToRoute('admin.dashboard');
    }

}
