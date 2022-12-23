<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'category_id' => ['required', Rule::exists('categories', 'id')],
                'name' => ['required'],
                'content' => ['required', 'min:10'],
                'price' => ['required', 'numeric', 'min:1'],
                'typeGender' => ['required', Rule::in(['W', 'w', 'M', 'm', 'B', 'b'])],
            ];
        } else {
            return [
                'category_id' => ['sometimes', 'required', Rule::exists('categories', 'id')],
                'name' => ['sometimes', 'required'],
                'content' => ['sometimes', 'required', 'min:10'],
                'price' => ['sometimes', 'required', 'numeric', 'min:1'],
                'typeGender' => ['sometimes', 'required', Rule::in(['W', 'w', 'M', 'm', 'B', 'b'])],
            ];
        }
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'type_gender' => $this->typeGender
        ]);
    }
}
