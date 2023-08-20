<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        return [
            'company_name' => 'required|min:3|max:160',
            'title' => 'required',
            'first_name' => 'required|min:3|max:35',
            'last_name' => 'required|min:3|max:35',
            'phone' => 'required|numeric',
            'company_phone' => 'required|numeric',
            'city' => 'required',
            'country_id' => 'required|numeric',
            'email' => [Rule::unique('users')->where(function ($query) {
                return $query->where('id', '!=', request()->route('id'))->whereDeletedAt(null);
            })],
            'company_email' => [Rule::unique('users')->where(function ($query) {
                return $query->where('id', '!=', request()->route('id'))->whereDeletedAt(null);
            })],
            // 'email' => 'required|email|unique:users,email,' . $id,
            // 'phone' => [Rule::unique('users')->where(function ($query) {
            //     return $query->where('id', '!=', request()->route('id'))->whereDeletedAt(null);
            // })],
            'password' => 'nullable',
            'other_title' => 'required_if:title,other',

        ];
    }


}
