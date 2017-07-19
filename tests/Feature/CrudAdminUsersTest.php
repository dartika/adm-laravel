<?php

namespace Tests\Feature;

use Dartika\Adm\Models\AdmUser;
use Dartika\Adm\Tests\TestCase;

class CrudAdminUsersTest extends TestCase
{
    public function test_admin_can_list_admin_users()
    {
        $user = factory(AdmUser::class)->create();

        $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
             ->get('adm/adm-users')
             ->assertSee($user->email)
             ->assertSee($admUser->email);
    }

    public function test_admin_can_create_admin_user()
    {
        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->post('adm/adm-users', [ 'email' => 'admin@mail.com', 'password' => 'password', 'password_confirmation' => 'password' ]);

        $response->assertRedirect('adm/adm-users');

        $this->assertDatabaseHas('admin_users', [ 'email' => 'admin@mail.com' ]);
    }

    public function test_admin_cant_create_admin_user_without_required_fields()
    {
        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->post('adm/adm-users', [ 'email' => '', 'password' => '' ]);

        $response->assertRedirect()
                 ->assertSessionHasErrors(['email', 'password']);

        $this->assertSame(1, AdmUser::all()->count());
    }

    public function test_admin_cant_create_admin_user_without_password_confirmed()
    {
        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->post('adm/adm-users', [ 'email' => 'admin@mail.com', 'password' => 'password' ]);

        $response->assertRedirect()
                 ->assertSessionHasErrors(['password']);

        $this->assertSame(1, AdmUser::all()->count());
    }

    public function test_admin_cant_create_admin_user_with_wrong_password_confirmed()
    {
        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->post('adm/adm-users', [ 'email' => 'admin@mail.com', 'password' => 'password', 'password_confirmation' => 'otherpassword' ]);

        $response->assertRedirect()
                 ->assertSessionHasErrors(['password']);

        $this->assertSame(1, AdmUser::all()->count());
    }

    public function test_admin_cant_create_two_admin_user_with_same_email()
    {
        $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
             ->post('adm/adm-users', [ 'email' => 'admin@mail.com', 'password' => 'password', 'password_confirmation' => 'password' ]);

        $this->assertSame(2, AdmUser::all()->count());

        $response = $this->post('adm/adm-users', [ 'email' => 'admin@mail.com', 'password' => 'otherpassword', 'password_confirmation' => 'otherpassword' ]);

        $response->assertRedirect()
                 ->assertSessionHasErrors(['email']);

        $this->assertSame(2, AdmUser::all()->count());
    }

    public function test_admin_can_show_admin_user()
    {
        $user = factory(AdmUser::class)->create();

        $this->actingAs($this->defaultAdmUser(), 'adm')
             ->get("adm/adm-users/{$user->id}")
             ->assertSee($user->email);
    }

    public function test_admin_can_update_user()
    {
        $user = factory(AdmUser::class)->create();

        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->put("adm/adm-users/{$user->id}", [ 'email' => 'admin@mail.com', 'password' => 'otherpassword', 'password_confirmation' => 'otherpassword' ]);

        $response->assertRedirect('adm/adm-users');

        $this->assertDatabaseHas('admin_users', [ 'id' => $user->id, 'email' => 'admin@mail.com' ]);
    }

    public function test_admin_cant_update_user_without_required_fields()
    {
        $user = factory(AdmUser::class)->create();

        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->put("adm/adm-users/{$user->id}", [ 'email' => '' ]);

        $response->assertRedirect()
                 ->assertSessionHasErrors(['email']);

        $this->assertDatabaseHas('admin_users', [ 'id' => $user->id, 'email' => $user->email ]);
    }

    public function test_admin_cant_update_user_password_without_confirm()
    {
        $user = factory(AdmUser::class)->create();

        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->put("adm/adm-users/{$user->id}", [ 'email' => $user->email, 'password' => 'password' ]);

        $response->assertRedirect()
                 ->assertSessionHasErrors(['password']);
    }

    public function test_admin_cant_update_user_with_same_another_user_mail()
    {
        $user = factory(AdmUser::class)->create();
        $otherUser = factory(AdmUser::class)->create(['email' => 'admin@mail.com']);

        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->put("adm/adm-users/{$user->id}", [ 'email' => 'admin@mail.com' ]);

        $response->assertRedirect()
                 ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('admin_users', [ 'id' => $user->id, 'email' => 'admin@mail.com' ]);
    }

    public function test_admin_can_delete_admin_user()
    {
        $user = factory(AdmUser::class)->create();

        $this->assertDatabaseHas('admin_users', [ 'id' => $user->id ]);

        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->delete("adm/adm-users/{$user->id}");

        $response->assertRedirect('adm/adm-users');

        $this->assertDatabaseMissing('admin_users', [ 'id' => $user->id ]);
    }

    public function test_admin_cant_delete_itself()
    {
        $response = $this->actingAs($admUser = $this->defaultAdmUser(), 'adm')
                         ->delete("adm/adm-users/{$admUser->id}");
                         
        $response->assertRedirect()
                 ->assertSessionHasErrors();

        $this->assertDatabaseHas('admin_users', [ 'id' => $admUser->id ]);
    }
}
