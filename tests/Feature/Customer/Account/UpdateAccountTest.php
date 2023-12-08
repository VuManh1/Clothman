<?php

namespace Tests\Feature\Customer\Account;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_account()
    {
        $user = User::factory()->create();

        $name = 'New name';
        $phonenumber = '0867676676';
        $address = 'New address';

        $response = $this->actingAs($user)->put(route('api.me.infor.update'), [
            'name' => $name,
            'phonenumber' => $phonenumber,
            'address' => $address
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $name,
            'phone_number' => $phonenumber,
            'address' => $address
        ]);
    }

    public function test_user_can_change_password()
    {
        $user = User::create([
            'name' => 'Test user',
            'email' => 'email1@gmail.com',
            'password' => Hash::make('11111111')
        ]);

        $newPassword = '22222222';

        $response = $this->actingAs($user)->patch(route('api.me.password.update'), [
            'old_password' => '11111111',
            'password' => $newPassword,
        ], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);

        $user = User::find($user->id);
        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
