<?php

namespace App\Http\Controllers;

use App\Actions\Album\CreateAlbum;
use App\Actions\Album\UpdateAlbum;
use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('artist')->latest()->paginate(9);

        return Inertia::render('Albums/Index', [
            'albums' => $albums,
        ]);
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get(['id', 'name']);

        return Inertia::render('Albums/Create', [
            'artists' => $artists,
        ]);
    }

    public function store(StoreAlbumRequest $request, CreateAlbum $createAlbum)
    {
        $createAlbum->execute($request);

        return redirect()->route('albums.index')->with('message', 'albums.created');
    }

    public function show(Album $album)
    {
        $album->load('artist');

        return Inertia::render('Albums/Show', [
            'album' => $album,
        ]);
    }

    public function edit(Album $album)
    {
        $album->load('artist');

        return Inertia::render('Albums/Edit', [
            'album' => $album,
        ]);
    }

    public function update(Request $request, Album $album, UpdateAlbum $updateAlbum)
    {
        $updateAlbum->execute($request, $album);

        return redirect()->route('albums.edit', $album)->with('message', 'albums.updated');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('message', 'albums.deleted');
    }
}
