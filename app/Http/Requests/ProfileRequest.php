<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'self_introduction'=>'max:160 | nullable',
            'goal'=>'max:110 | nullable',
        ];
    }
    
    public function attributes()
    {
        return [
            'self_introduction'=>'自己紹介',
            'goal'=>'達成目標',
        ];
    }
}
