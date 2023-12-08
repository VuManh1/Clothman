<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_login()
    {
        $user = User::create([
            'name' => 'user 1',
            'email' => 'email1@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '11111111',
        ]);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
        $this->assertTrue(Auth::check());
    }

    public function test_staff_and_admin_can_login()
    {
        $user = User::create([
            'name' => 'user 1',
            'email' => 'email1@gmail.com',
            'password' => Hash::make('11111111'),
            'role' => 'STAFF'
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '11111111',
        ]);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('admin.dashboard');
        $this->assertTrue(Auth::check());
    }

    public function test_it_fail_if_missing_field()
    {
        User::create([
            'name' => 'user 1',
            'email' => 'email1@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $response = $this->post(route('login'), [
            'password' => '11111111',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_user_can_not_login_if_credentical_incorrect()
    {
        $user = User::create([
            'name' => 'user 1',
            'email' => 'email1@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '22222222',
        ]);

        $response->assertSessionHasErrors();
        $this->assertTrue(!Auth::check());
    }
}
