<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AlbumControllerPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsRole(string $roleName): User
    {
        $role = Role::firstOrCreate(['name' => $roleName]);
        $user = User::factory()->create(['role_id' => $role->id]);
        $this->actingAs($user);
        return $user;
    }

    #[DataProvider('rolesForIndex')]
    public function test_index_access_by_role(string $role, int $expectedStatus): void
    {
        $this->actingAsRole($role);
        $response = $this->get(route('albums.index'));
        $response->assertStatus($expectedStatus);
    }

    #[DataProvider('rolesForShow')]
    public function test_show_access_by_role(string $role, int $expectedStatus): void
    {
        $this->actingAsRole($role);
        $album = Album::factory()->forArtist()->create();
        $response = $this->get(route('albums.show', $album));
        $response->assertStatus($expectedStatus);
    }

    #[DataProvider('rolesForCreate')]
    public function test_create_access_by_role(string $role, int $expectedStatus): void
    {
        $this->actingAsRole($role);
        $response = $this->get(route('albums.create'));
        $response->assertStatus($expectedStatus);
    }

    #[DataProvider('rolesForStore')]
    public function test_store_access_by_role(string $role, int $expectedStatus): void
    {
        $this->actingAsRole($role);
        $artist = Artist::factory()->create();

        $data = [
            'artist_id' => $artist->id,
            'name' => 'New Album',
            'year' => 2023,
        ];

        $response = $this->post(route('albums.store'), $data);
        $response->assertStatus($expectedStatus);
    }

    #[DataProvider('rolesForUpdate')]
    public function test_edit_access_by_role(string $role, int $expectedStatus): void
    {
        $this->actingAsRole($role);
        $album = Album::factory()->forArtist()->create();

        $response = $this->get(route('albums.edit', $album));
        $response->assertStatus($expectedStatus);
    }

    #[DataProvider('rolesForUpdatePost')]
    public function test_update_access_by_role(string $role, int $expectedStatus): void
    {
        $this->actingAsRole($role);
        $album = Album::factory()->forArtist()->create();

        $data = [
            'name' => 'Updated Album',
            'artist_id' => $album->artist->id,
            'year' => 2024,
        ];

        $response = $this->put(route('albums.update', $album), $data);
        $response->assertStatus($expectedStatus);
    }

    #[DataProvider('rolesForDelete')]
    public function test_destroy_access_by_role(string $role, int $expectedStatus): void
    {
        $this->actingAsRole($role);
        $album = Album::factory()->forArtist()->create();

        $response = $this->delete(route('albums.destroy', $album));
        $response->assertStatus($expectedStatus);
    }

    public static function rolesForIndex(): array
    {
        return [
            [RoleEnum::ADMIN->value, Response::HTTP_OK],
            [RoleEnum::EDITOR->value, Response::HTTP_OK],
            [RoleEnum::VIEWER->value, Response::HTTP_OK],
        ];
    }

    public static function rolesForShow(): array
    {
        return [
            [RoleEnum::ADMIN->value, Response::HTTP_OK],
            [RoleEnum::EDITOR->value, Response::HTTP_OK],
            [RoleEnum::VIEWER->value, Response::HTTP_OK],
        ];
    }

    public static function rolesForCreate(): array
    {
        return [
            [RoleEnum::ADMIN->value, Response::HTTP_OK],
            [RoleEnum::EDITOR->value, Response::HTTP_OK],
            [RoleEnum::VIEWER->value, Response::HTTP_FORBIDDEN],
        ];
    }

    public static function rolesForStore(): array
    {
        return [
            [RoleEnum::ADMIN->value, Response::HTTP_FOUND],
            [RoleEnum::EDITOR->value, Response::HTTP_FOUND],
            [RoleEnum::VIEWER->value, Response::HTTP_FORBIDDEN],
        ];
    }

    public static function rolesForUpdate(): array
    {
        return [
            [RoleEnum::ADMIN->value, Response::HTTP_OK],
            [RoleEnum::EDITOR->value, Response::HTTP_OK],
            [RoleEnum::VIEWER->value, Response::HTTP_FORBIDDEN],
        ];
    }

    public static function rolesForUpdatePost(): array
    {
        return [
            [RoleEnum::ADMIN->value, Response::HTTP_FOUND],
            [RoleEnum::EDITOR->value, Response::HTTP_FOUND],
            [RoleEnum::VIEWER->value, Response::HTTP_FORBIDDEN],
        ];
    }

    public static function rolesForDelete(): array
    {
        return [
            [RoleEnum::ADMIN->value, Response::HTTP_FOUND],
            [RoleEnum::EDITOR->value, Response::HTTP_FORBIDDEN],
            [RoleEnum::VIEWER->value, Response::HTTP_FORBIDDEN],
        ];
    }
}
