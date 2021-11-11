<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=> 'required | max:40',
            'time'=>'required',
            'body'=>'required | max:210',
            'image_url'=>'file|mimes:jpeg,png,jpg,bmb|max:2048'
        ];
    }
    
    public function attributes()
    {
        return [
            'title'=>'タイトル',
            'time'=>'時間',
            'body'=>'本文',
            'image_url'=>'画像'
            ];
    }
}
