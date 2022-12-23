<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCategoryRequest extends FormRequest
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

        if($method == 'PUT') {
            return [
                'name' => ['required'],
                'slug' => ['required'],
                'content' => ['required', 'min:10']
            ];
        } else {
            return [
                'name' => ['sometimes', 'required'],
                'slug' => ['sometimes', 'required'],
                'content' => ['sometimes', 'required', 'min:10']
            ];
        }

    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }
}
