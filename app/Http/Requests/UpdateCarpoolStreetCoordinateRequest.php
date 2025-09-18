<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCarpoolStreetCoordinateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'street'               => ['required'],
            'zip_code'              => ['required'],
            'city'                  => ['required'],
            'country'               => ['required'],
            'external_api_id'       => ['required'],
            'external_api_source'   => ['required'],
            'osm_id'                => ['required'],
            'osm_way'               => ['required'],
            'lat'                   => ['required'],
            'lng'                   => ['required'],
            'user_id'               => ['required'],
            'manually_validated'    => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
