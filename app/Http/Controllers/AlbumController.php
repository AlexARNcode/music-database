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
        $albums = Album::all()->where('deleted_at', null);

        return Inertia::render('Albums/Index', [
            'albums' => $albums
        ]);
    }

    public function create()
    {
        return Inertia::render('Albums/Create');
    }

    public function store(StoreAlbumRequest $request)
    {
        $image_path = null;

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('images', 'public');
        }

        Album::create([
            'artist'    => $request->get('artist'),
            'name'      => $request->get('name'),
            'year'      => $request->get('year'),
            'label'     => $request->get('label'),
            'producer'  => $request->get('producer'),
            'image'     => $image_path,
        ]);

        return redirect('/albums/create')->with('message', 'Album successfully added!');
    }

    public function show(Album $album)
    {
        return Inertia::render('Albums/Show', ['album' => $album]);
    }


    public function edit(Album $album)
    {
        return Inertia::render('Albums/Edit', ['album' => $album]);
    }


    public function update(UpdateAlbumRequest $request)
    {
        Album::find($request->get('id'))
            ->update([
                'artist'    => $request->get('artist'),
                'name'      => $request->get('name'),
                'year'      => $request->get('year'),
                'image'     => $request->get('image'),
                'label'     => $request->get('label'),
                'producer'  => $request->get('producer'),
            ]);

            return redirect()->back()->with('message', 'Album successfully updated!');
    }


    public function delete(Album $album)
    {
       $album->delete();

       return redirect()->back()->with('message', 'Album successfully deleted!');
    }
}
