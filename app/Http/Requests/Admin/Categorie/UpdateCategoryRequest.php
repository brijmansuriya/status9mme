<?php

namespace App\Http\Requests\Admin\Categorie;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'image|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'image.max' => 'The image may not be greater than 5MB.',
        ];
    }
}
