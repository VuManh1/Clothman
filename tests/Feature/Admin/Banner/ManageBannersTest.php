<?php

namespace Tests\Feature\Admin\Banner;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManageBannersTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_not_view_manage_banners_page(): void {
        $user = User::create([
            'name' => 'Test staff 1',
            'email' => 'email1@gmail.com',
            'role' => 'STAFF'
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.banners.index'));

        $response->assertStatus(403);
    }

    public function test_admin_can_view_manage_banners_page(): void {
        $user = User::create([
            'name' => 'Test admin 1',
            'email' => 'email1@gmail.com',
            'role' => 'ADMIN'
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.banners.index'));

        $response->assertStatus(200);
    }

    // public function test_create_banner_success(): void {
    //     $user = User::create([
    //         'name' => 'Test admin 1',
    //         'email' => 'email1@gmail.com',
    //         'role' => 'ADMIN'
    //     ]);

    //     Storage::fake('images/banner_images');

    //     $response = $this->actingAs($user)
    //         ->post(
    //             route('admin.banners.store'),
    //             [
    //                 '_token' => csrf_token(),
    //                 'name' => 'Banner 1',
    //                 'image' => UploadedFile::fake()->image('banner1.jpg')
    //             ]
    //         );

    //     Storage::disk('images/banner_images')->exists('banner1.jpg');

    //     $response->assertStatus(302);
    //     $response->assertRedirectToRoute('admin.banners.index');
    //     $response->assertSessionHas('success');
    // }

    public function test_create_banner_failed_if_missing_field(): void {
        $user = User::create([
            'name' => 'Test admin 1',
            'email' => 'email1@gmail.com',
            'role' => 'ADMIN'
        ]);

        $response = $this->actingAs($user)
            ->post(
                route('admin.banners.store'),
                [
                    '_token' => csrf_token(),
                    'name' => 'Banner 1',
                ]
            );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('image');
    }
}
