<?php

namespace App\Http\Requests\Admin\Image;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'nullable|file|mimes:jpg,png,jpeg,webp|max:5000',
            // 'image.*' => 'required|file|mimes:jpg,png,jpeg,webp|max:5000', // Validate each file
        ];
    }

    public function messages()
    {
        return [
            'image.max' => 'The image may not be greater than 5MB.',
        ];
    }

    //preper data
    // public function prepareForValidation()
    // {
    //     //sting to array jsone decode 
    //     if (is_string($this->image)) {
    //         $this->merge([
    //             'image' => json_decode($this->image, true),
    //         ]);
    //     }
    // }
}
