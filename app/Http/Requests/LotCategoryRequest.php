<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LotCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:128|unique:lot_categories,name'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Category name is required!',
            'name.string' => 'Category name must be a string!',
            'name.max' => 'Category name must consist maximum of 128 characters!',
            'name.unique' => 'Category name must be unique!',
        ];
    }
}
