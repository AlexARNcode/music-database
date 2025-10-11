<?php

namespace Tests\Unit;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_a_user_can_have_a_role(): void
    {
        $role = Role::factory()->create(['name' => RoleEnum::ADMIN->value]);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertEquals(RoleEnum::ADMIN->value, $user->role->name);
    }

    public function test_if_user_has_role_admin(): void
    {
        $role = Role::factory()->create(['name' => RoleEnum::ADMIN->value]);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertTrue($user->hasRole(RoleEnum::ADMIN));
    }
}
