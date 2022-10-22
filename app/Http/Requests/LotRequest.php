<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LotRequest extends FormRequest
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
            'name' => 'required|string|max:128',
            'description' => 'required|string',
            'lot_category_id' => 'required|exists:lot_categories,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Lot name is required!',
            'name.string' => 'Lot name must be a string!',
            'name.max' => 'Lot name must consist maximum of 128 characters!',
            'description.required' => 'Lot description is required!',
            'description.string' => 'Lot description must be a string!',
            'lot_category_id.required' => 'Lot category is required!',
            'lot_category_id.exists' => 'Lot category must exists!'
        ];
    }
}
