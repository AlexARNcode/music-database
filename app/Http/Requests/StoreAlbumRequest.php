<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'artist'    => 'required|string',
            'name'      => 'required|string',
            'year'      => 'required|integer',
            'label'     => 'nullable|string',
            'producer'  => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'artist.required' => 'The artist name is required.',
            'name.required' => 'The album name is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.max' => 'The image must not be larger than 2MB.',
        ];
    }
}
