<?php

namespace App\Http\Requests\Admin\Member;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'title' => 'required',
            'first_name' => 'required|min:3|max:35',
            'last_name' => 'required|min:3|max:35',
            'phone' => 'required',
            'email' => 'required',
            'country_code' => 'required',
            'other_title' => 'required_if:title,other',
            // 'email' => [Rule::unique('users')->where(function ($query) {
            //     return $query->where('id', '!=', request()->route('id'))->whereDeletedAt(null);
            // })],
        ];
    }


}
