<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'date_of_birth' => 'before:now',
            'phone' => 'regex:/^\+?[0-9]{9,13}$/',
            'avatar' => 'mimes:jpg,png,jpeg|max:5120',
        ];
    }
}