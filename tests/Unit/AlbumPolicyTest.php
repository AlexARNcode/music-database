<?php

namespace Tests\Unit;

use App\Enums\RoleEnum;
use App\Models\Album;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Policies\AlbumPolicy;
use PHPUnit\Framework\Attributes\DataProvider;

class AlbumPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (RoleEnum::cases() as $roleEnum) {
            Role::firstOrCreate(['name' => $roleEnum->value]);
        }
    }


    #[DataProvider('rolePolicyProvider')]
    public function test_policy_access(string $roleName, string $policyMethod, bool $expected): void
    {
        $role = Role::where('name', $roleName)->firstOrFail();

        $user = User::factory()->make(['role_id' => $role->id]);
        $album = Album::factory()->make();

        $policy = new AlbumPolicy();

        $result = $policy->$policyMethod($user, $album);
        $this->assertSame($expected, $result);
    }

    public static function rolePolicyProvider(): array
    {
        return [

            [RoleEnum::VIEWER->value, 'viewAny',    true],
            [RoleEnum::VIEWER->value, 'view',       true],
            [RoleEnum::VIEWER->value, 'create',     false],
            [RoleEnum::VIEWER->value, 'update',     false],
            [RoleEnum::VIEWER->value, 'delete',     false],

            [RoleEnum::EDITOR->value, 'viewAny',    true],
            [RoleEnum::EDITOR->value, 'view',       true],
            [RoleEnum::EDITOR->value, 'create',     true],
            [RoleEnum::EDITOR->value, 'update',     true],
            [RoleEnum::EDITOR->value, 'delete',     false],

            [RoleEnum::ADMIN->value,  'viewAny',    true],
            [RoleEnum::ADMIN->value,  'view',       true],
            [RoleEnum::ADMIN->value,  'create',     true],
            [RoleEnum::ADMIN->value,  'update',     true],
            [RoleEnum::ADMIN->value,  'delete',     true],
        ];
    }
}
