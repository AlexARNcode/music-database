<?php

namespace App\Actions\Album;

use App\Http\Requests\StoreAlbumRequest;
use App\Jobs\SendAlbumCreatedEmail;
use App\Models\Album;
use App\Models\Artist;

class CreateAlbum
{
    public function execute(StoreAlbumRequest $request): Album
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $artistId = $request->artist_id;

        if ($this->isNewArtist($request)) {
            $artist = Artist::create([
                'name' => $request->new_artist_name,
            ]);
            $artistId = $artist->id;
        }

        $album = Album::create([
            'artist_id' => $artistId,
            'name'      => $request->name,
            'year'      => $request->year,
            'label'     => $request->label,
            'producer'  => $request->producer,
            'image'     => $imagePath,
        ]);

        SendAlbumCreatedEmail::dispatch($album);

        return $album;
    }

    private function isNewArtist(StoreAlbumRequest $request): bool
    {
        return !$request->artist_id && $request->filled('new_artist_name');
    }
}
