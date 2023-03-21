<?php

namespace App\Http\Requests\Desks\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
            'title' => 'string|max:255',
            'description' => 'string|max:255',
            'elapsed_time' => 'integer|max:200',
            'img_src' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'desk_column_id' => 'integer|exists:desk_columns,id'
        ];
    }
}
