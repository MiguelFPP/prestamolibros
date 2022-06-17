<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|max:255',
            'edition' => 'required|string|max:255',
            'published_at' => 'required|date',
            'stock' => 'required|integer',
            'author_id' => 'required|exists:authors,id',
            'categories' => 'required|array',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Titulo',
            'edition' => 'Edición',
            'published_at' => 'Fecha de publicación',
            'stock' => 'Stock',
            'author_id' => 'Autor',
            'categories' => 'Categorías',
        ];
    }
}
