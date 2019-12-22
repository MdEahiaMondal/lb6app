<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'body' => 'required',
            'image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'titel is nedd must',
        ];
    }


    public function attributes()
    {
        return [
            'body' => 'long text'
        ];
    }


}
