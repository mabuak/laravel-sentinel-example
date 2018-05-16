<?php

namespace Tests\Feature;

use App\Models\Auth\User;
use App\Models\Company;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Test Company Registration
     */
    public function testCompanyRegistration(){

        $company = factory(Company::class)->make()->toArray();
        $user = factory(User::class)->make()->toArray();

        $requestData = array_merge($company, $user);

        $requestData['company_name'] = $company['name'];
        $requestData['password'] = 'password';
        $requestData['password_confirmation'] = 'password';

        $response = $this->post(route('register.action'), $requestData);

        $response->assertSessionHas('success');
        $response->assertRedirect(route('login.form'));
    }

    /**
     * Test Activation Registration
     */
    public function testActivationRegistration(){
        $user = User::orderBy('id', 'desc')->first();
        $activation = Activation::exists($user);

        $response = $this->get(route('register.activate', [$activation->user_id, $activation->code]));
        $response->assertSessionHas('success');
        $response->assertRedirect(route('login.form'));
    }

    /**
     * Test Login Form
     */
    public function testLoginForm()
    {
        $response = $this->get(route('login.form'));
        $response->assertStatus(200);
    }

    /**
     * Testing For Login Test
     */
    public function testProcessLoginFailed(){

        Sentinel::disableCheckpoints();

        $credentials = [
            'email' => 'admin@admin.com',
            'password' => 'passwords',
        ];

        $response = $this->post(route('login.action', $credentials));

        $response->assertSessionHas('failed');
        $response->assertRedirect(route('login.form'));
    }

    /**
     * Testing For Login Test
     */
    public function testProcessLogin(){

        $credentials = [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ];

        $response = $this->post(route('login.action', $credentials));
        $response->assertSessionHas('success');
        $response->assertRedirect(route('dashboard'));
    }

    /**
     * Testing For Log Out
     */
    public function testLogout(){
        $response = $this->get(route('logout'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login.form'));
    }
}
