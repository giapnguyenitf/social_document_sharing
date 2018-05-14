<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
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
            'name' => 'required|string|min:10|max:200',
            'description' => 'required|string|min:50|max:1000',
            'document' => 'required|max:10240|mimes:pdf,ppt,pptx',
            'parent_category' => 'required',
        ];
    }
}
