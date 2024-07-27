<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $album = Album::find(1);
        $genre = Genre::find(1);

        $album->genres()->sync($genre);
    }
}
