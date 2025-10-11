<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlbumControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $role = Role::factory()->create(['name' => RoleEnum::ADMIN->value]);
        $this->user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($this->user);
    }
    

    public function test_index_displays_albums()
    {
        $album = Album::factory()->forArtist()->create();

        $response = $this->get(route('albums.index'));

        $response->assertStatus(200);
        $response->assertSee($album->title);
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('albums.create'));

        $response->assertStatus(200);
    }

    public function test_store_creates_album()
    {
        $artist = Artist::factory()->create();

        $data = [
            'artist_id' => $artist->id,
            'name' => 'Test Album',
            'year' => 2022,
        ];
        

        $response = $this->post(route('albums.store'), $data);

        $response->assertRedirect(route('albums.index'));
        $this->assertDatabaseHas('albums', ['name' => 'Test Album']);
        $response->assertSessionHas('message', 'albums.created');
    }

    public function test_show_displays_album()
    {
        $album = Album::factory()->forArtist()->create();

        $response = $this->get(route('albums.show', $album));

        $response->assertStatus(200);
        $response->assertSee($album->title);
    }

    public function test_edit_displays_edit_form()
    {
        $album = Album::factory()->forArtist()->create();

        $response = $this->get(route('albums.edit', $album));

        $response->assertStatus(200);
        $response->assertSee($album->title);
    }

    public function test_update_modifies_album()
    {
       $album  = Album::factory()->forArtist()->create();
       $artist = $album->artist;

        $data = [
            'name' => 'Updated Title',
            'artist_id' => $artist->id,
            'year' => 2023,

        ];

        $response = $this->put(route('albums.update', $album), $data);

        $response->assertRedirect(route('albums.edit', $album));
        $this->assertDatabaseHas('albums', ['name' => 'Updated Title']);
        $response->assertSessionHas('message', 'albums.updated');
    }

    public function test_destroy_deletes_album()
    {
        $album = Album::factory()->forArtist()->create();

        $response = $this->delete(route('albums.destroy', $album));

        $response->assertRedirect(route('albums.index'));
        $this->assertSoftDeleted('albums', ['id' => $album->id]);
        $response->assertSessionHas('message', 'albums.deleted');
    }
}
