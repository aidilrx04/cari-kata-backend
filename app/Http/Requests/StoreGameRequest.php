<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'words' => ['required', 'array', 'min:1'], // at least a word exist
            'grid' => ['required'],
            'grid.rows' => ['required', 'integer', 'min:1'],
            'grid.columns' => ['required', 'integer', 'min:1'],
            'grid.grid' => ['required', 'array', 'min:1'],
            'grid.grid.*' => ['required', 'array', 'min:1'],
            'grid.solved' => ['required', 'array', 'min:1'],
            'grid.solved.*' => ['required', 'array', 'min:1']
        ];
    }
}
