<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveUpdateRequest extends FormRequest
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
            // 'user_id' => ['required', 'integer',],
            'start_date' => ['required', 'string', 'max:50'],
            'end_date' => ['required', 'string', 'max:50'],
            'leave_type' => ['required', 'string', 'max:200'],
            'reason_for_leave' => ['required', 'string', 'max:200'],
            'status' => ['required', 'string', 'max:50'],
        ];
    }
}
