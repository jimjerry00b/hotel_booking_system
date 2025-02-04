<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'hotel_id'          => 'required',
            'room_number'    => 'required|string|min:2|max:50',
            'type'           => 'required|min:1|max:50',
            'price'          => 'required|min:1|max:50',
            'capacity'       => 'required|min:1|max:50',
        ];
    }
}
