<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all()->where('deleted_at', null);

        return Inertia::render('Albums/Index', [
            'albums' => $albums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
