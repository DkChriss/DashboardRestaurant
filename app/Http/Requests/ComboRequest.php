<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComboRequest extends FormRequest
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
            'name' => 'required|string|unique:combos,name',
            'price' => 'required|integer',
            'dish_id' => 'required|exists:dishes,id|integer',
            'drink_id' => 'required|exists:drinks,id|integer'
        ];

        if($this->getMethod() === 'PATCH') {
            $rules ['name'] = $rules['name'] . ',' . $this->combo->id;
        }
        
        return $rules;
    }
}
