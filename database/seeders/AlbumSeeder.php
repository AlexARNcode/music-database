<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;
use  App\Models\Artist;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Artist::count() === 0) {
            Artist::factory()->count(20)->create();
        }

        Album::factory()
            ->count(50)
            ->create();
    }
}
