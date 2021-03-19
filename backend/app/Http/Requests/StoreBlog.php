<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlog extends FormRequest
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
            'title' => 'required|string|max:50',
            // 'target_site' => 'required',
            'content' => 'required|string|max:500',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            // 'target_site' => '鍛えた部位',
            'content' => '本文',
        ];
    }
}
