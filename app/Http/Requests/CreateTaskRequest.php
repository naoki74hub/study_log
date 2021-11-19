<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'title'=>'required | max:40',
            'estimate_hour'=>'nullable | max:10',
            'due_date'=>' nullable | date | after_or_equal:today',
        ];
    }
    
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'estimate_hour'=>'見積もり時間',
            'due_date'=>'期限日'
            ];
    }
    
     public function messages()
    {
        return [
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
