<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlbumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        if ($this->filled('new_artist_name')) {
            $this->merge(['artist_id' => null]);
        }
    }

    public function rules(): array
    {
        return [
            'artist_id'       => ['nullable', 'exists:artists,id'],
            'new_artist_name' => ['nullable', 'string', 'max:255'],
            'name'            => ['required', 'string', 'max:255'],
            'year'            => ['required', 'integer'],
            'label'           => ['nullable', 'string', 'max:255'],
            'producer'        => ['nullable', 'string', 'max:255'],
            'image'           => ['nullable', 'image'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            if (!$this->filled('artist_id') && !$this->filled('new_artist_name')) {
                $v->errors()->add('artist_id', 'You must select or create an artist.');
            }
        });
    }
}
