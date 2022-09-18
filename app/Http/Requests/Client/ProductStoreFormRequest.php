<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreFormRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:1500'],
            'manufacture_date' => ['required', 'date', 'date_format:Y-m-d'],
            'warehouses' => ['nullable', 'array'],
            'warehouses.*.id' => ['exists:warehouses'],
            'warehouses.*.price' => ['numeric'],
            'warehouses.*.amount' => ['integer']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'warehouses' => collect($this->input('warehouses'))->filter(function ($item) {
                return !is_null($item['price']) && !is_null($item['amount']);
            })->toArray()
        ]);
    }
}
