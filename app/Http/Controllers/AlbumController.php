<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use Inertia\Inertia;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();

        return Inertia::render('Albums/Index', [
            'albums' => $albums,
        ]);
    }

    public function create()
    {
        return Inertia::render('Albums/Create');
    }

    public function store(StoreAlbumRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Album::create([
            'artist'   => $request->artist,
            'name'     => $request->name,
            'year'     => $request->year,
            'label'    => $request->label,
            'producer' => $request->producer,
            'image'    => $imagePath,
        ]);

        return redirect()->route('albums.create')->with('message', 'Album successfully added!');
    }

    public function show(Album $album)
    {
        return Inertia::render('Albums/Show', [
            'album' => $album,
        ]);
    }

    public function edit(Album $album)
    {
        return Inertia::render('Albums/Edit', [
            'album' => $album,
        ]);
    }

    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $data = $request->only(['artist', 'name', 'year', 'label', 'producer']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $album->update($data);

        return redirect()->route('albums.edit', $album)->with('message', 'Album successfully updated!');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('message', 'Album successfully deleted!');
    }
}
