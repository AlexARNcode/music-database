<?php

namespace App\Actions\Album;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateAlbum
{
    public function execute(Request $request, Album $album): Album
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($album->image) {
                Storage::disk('public')->delete($album->image);
            }

            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $album->update($data);

        return $album;
    }
}
