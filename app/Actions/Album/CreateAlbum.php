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

        $album = Album::create([
            'artist_id' => Artist::query()->first()?->id, // TODO: replace with real artist
            'name'      => $request->name,
            'year'      => $request->year,
            'label'     => $request->label,
            'producer'  => $request->producer,
            'image'     => $imagePath,
        ]);

        SendAlbumCreatedEmail::dispatch($album);

        return $album;
    }
}
