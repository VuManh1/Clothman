<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Utils\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register() {
        $name = 'Test user';
        $phonenumber = '0878676767';
        $email = 'email1@gmail.com';

        $response = $this->post(route('register'), [
            'name' => $name,
            'phonenumber' => $phonenumber,
            'email' => $email,
            'password' => '11111111',
        ]);

        $response->assertRedirectToRoute('verification.notice');
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'phone_number' => $phonenumber,
            'email' => $email,
            'role' => Role::CUSTOMER
        ]);
    }

    public function test_user_can_not_register_if_email_exists() {
        $user = User::factory()->create();

        $response = $this->post(route('register'), [
            'name' => "Test user",
            'phonenumber' => "0878676767",
            'email' => $user->email,
            'password' => '11111111',
        ]);

        $response->assertSessionHasErrors();
    }
}
