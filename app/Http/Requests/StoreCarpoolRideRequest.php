<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarpoolRideRequest extends FormRequest
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
            'travel_start_datetime'      => ['required'],
            'from_street_coordinates_id' => ['required', 'integer'],
            'to_street_coordinates_id'   => ['required', 'integer'],
            'luggage_id'                 => ['required', 'integer'],
            'seats_available'            => ['required'],
            'remark'                     => ['required'],
            'price_per_seat'             => ['required'],
            'user_id'                    => ['required', 'integer'],
        ];
    }
}
