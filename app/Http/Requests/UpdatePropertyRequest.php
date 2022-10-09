<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'property_type_id' => 'required',
            'county' => 'required',
            'country' => 'required',
            'town' => 'required',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'num_bedrooms' => 'required|numeric',
            'num_bathrooms' => 'required|numeric',
            'price' => 'required|numeric',
            'type' => 'required',
            'image' => 'sometimes|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
