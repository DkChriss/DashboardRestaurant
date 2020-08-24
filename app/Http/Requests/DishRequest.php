<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
            'name' => 'required|string|unique:dishes,name',
            'price' => 'required|integer|min:1',
        ];

        if($this->getMethod() === 'PATCH') {
            $rules ['name'] = $rules['name'] . ',' . $this->dish->id;
        }

        return $rules;
    }
}
