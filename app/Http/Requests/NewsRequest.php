<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'kategori_id' => 'required',
            'artis_id' => 'required',
            'penulis_id' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're uploading images
        ];
    }
}
