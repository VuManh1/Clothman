<?php

namespace Tests\Feature\Admin\Category;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageCategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_be_redirected_when_not_authenticate(): void {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    public function test_403_page_be_rendered_when_user_is_not_staff_or_admin(): void {
        $user = User::create([
            'name' => 'Test user 1',
            'email' => 'email1@gmail.com',
            'role' => 'CUSTOMER'
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.categories.index'));

        $response->assertStatus(403);
    }

    public function test_staff_or_admin_can_view_manage_categories_page(): void {
        $user = User::create([
            'name' => 'Test user 1',
            'email' => 'email1@gmail.com',
            'role' => 'STAFF'
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }

    public function test_create_category_failed_if_missing_field(): void {
        $user = User::create([
            'name' => 'Test user 1',
            'email' => 'email1@gmail.com',
            'role' => 'STAFF'
        ]);

        $response = $this->actingAs($user)
            ->post(
                route('admin.categories.store'),
                [
                    '_token' => csrf_token(),
                    'name' => 'Quan',
                ]
            );

        $response->assertStatus(302);
        $response->assertSessionHasErrors('banner');
    }
}
