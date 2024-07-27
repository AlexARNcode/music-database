<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'metal',
            'pop',
            'bluegrass',
            'rock',
            'jazz',
            'classical',
            'blues',
            'electro',
            'rap',
            'ambient',
            'country',
            'folk',
            'hip hop',
            'soul',
            'punk'
        ];

        foreach ($genres as $genre) {
            Genre::create(
                ['name' => $genre]
            );
        }
    }
}
 