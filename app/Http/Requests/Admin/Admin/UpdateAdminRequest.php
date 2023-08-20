<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
        $id = request()->route('id');
        $currentAdmin = request()->user();
        if ($currentAdmin == $id) {
            //if the current admin
            return [
                'name' => 'required',
                'email' => 'required|unique:admins,email,' . $id . ',id',
                'current_password' => 'required_with:new_password',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,webp'
            ];
        }

        return [
            'name' => 'required',
            'email' => 'required|unique:admins,email,' . $id . ',id',
            'image' => 'nullable|image'
            // 'password' => 'required',
        ];
    }
}
