<?php

namespace App\Http\Requests;

use Auth;
use Carbon\Carbon;
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
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|before:' . Carbon::today()->toDateString(),
            'phone' => 'nullable|regex:/^\+?[0-9]{9,13}$/'
        ];
    }
}
