<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:400'],
            'email' => ['required', 'email', 'max:100'],
            'gender' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:400'],
            'id_no' => ['required', 'string', 'max:100'],
            'dob' => ['required', 'string', 'max:30'],
            'grade_level' => ['required', 'string', 'max:200'],
            'district' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'class_course' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:400'],
            'school' => ['required', 'string', 'max:150'],
            'password' => ['required', 'string', 'max:8'],
        ];
    }
}
