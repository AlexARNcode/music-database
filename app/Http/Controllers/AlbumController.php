<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Jobs\SendAlbumCreatedEmail;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        return Inertia::render('Albums/Create');
    }

    public function store(StoreAlbumRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $album = Album::create([
            'artist_id' => Artist::query()->first()?->id, // TODO: WIP
            'name'      => $request->name,
            'year'      => $request->year,
            'label'     => $request->label,
            'producer'  => $request->producer,
            'image'     => $imagePath,
        ]);

        SendAlbumCreatedEmail::dispatch($album);

        return redirect()->route('albums.index')->with('message', 'Album successfully added!');
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

    public function update(Request $request, Album $album)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($album->image) {
                Storage::disk('public')->delete($album->image);
            }
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
