<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlbumRequest extends FormRequest
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
            'artist_id' => 'required|exists:artists,id',
            'name'      => 'required|string|max:255',
            'year'      => 'required|integer|min:1800|max:' . (date('Y') + 1),
            'label'     => 'nullable|string|max:255',
            'producer'  => 'nullable|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'artist_id.required' => 'The artist is required.',
            'artist_id.exists' => 'The selected artist does not exist.',
            'name.required' => 'The album name is required.',
            'name.max' => 'The album name may not be greater than 255 characters.',
            'year.required' => 'The year is required.',
            'year.integer' => 'The year must be an integer.',
            'year.min' => 'The year must be at least 1800.',
            'year.max' => 'The year may not be in the far future.',
            'label.max' => 'The label may not be greater than 255 characters.',
            'producer.max' => 'The producer may not be greater than 255 characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, gif, svg.',
            'image.max' => 'The image must not be larger than 2MB.',
        ];
    }
}
