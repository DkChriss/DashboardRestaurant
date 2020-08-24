<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrinkRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|unique:drinks,name',
            'price' => 'required|integer'
        ];

        if ($this->getMethod() === 'PATCH') {
            $rules ['name'] = $rules['name'] . ',' . $this->drink->id;
        }

        return $rules;
    }
}
