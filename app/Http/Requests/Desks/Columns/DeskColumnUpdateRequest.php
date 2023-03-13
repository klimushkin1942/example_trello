<?php

namespace App\Http\Requests\Desks\Columns;

use Illuminate\Foundation\Http\FormRequest;

class DeskColumnUpdateRequest extends FormRequest
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
            'status' => 'required|string|max:100',
        ];
    }
}
