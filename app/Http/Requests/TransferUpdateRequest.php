<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            // 'teacher_id' => ['required', 'integer', 'exists:teachers,id'],
            'current_place' => ['required', 'string', 'max:400'],
            'from_school' => ['required', 'string', 'max:200'],
            'to_school' => ['required', 'string', 'max:200'],
            'reason_for_transfer' => ['required', 'string', 'max:400'],
            'date_of_transfer' => ['required', 'string', 'max:400'],
            'status' => ['required', 'string', 'max:20'],
        ];
    }
}
