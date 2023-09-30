<?php

namespace App\Http\Requests\Admin\Explorer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExplorerRequest extends FormRequest
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
            'keywords' => 'required', // Adjust as needed
            'title' => 'required|string|max:255', // Adjust as needed
            'description' => 'required|string', // Adjust as needed
            'meta_description' => 'required|string|max:255', // Adjust as needed
            'image' => 'required|image|mimes:jpg,png,jpeg,webp',
        ];
    }

    public function messages()
    {
        return[
            'image.max' => 'The image may not be greater than 5MB.',
        ];
    }
}
