<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSharingOrgRequest extends FormRequest
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
            'name'                          => ['required'],
            'short_description'             => ['required'],
            'body'                          => [],
            'prop_vehicle_car'              => ['boolean'],
            'prop_vehicle_ecar'             => ['boolean'],
            'prop_vehicle_bike'             => ['boolean'],
            'prop_vehicle_ebike'            => ['boolean'],
            'prop_vehicle_cargobike'        => ['boolean'],
            'prop_vehicle_ecargobike'       => ['boolean'],
            'prop_vehicle_step'             => ['boolean'],

            'website'                       => ['required'],
            'email'                         => ['required'],

            'payment_subscription_info'     => [],
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
