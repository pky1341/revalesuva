<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')],
            'dob' => ['required', 'date'],
            'contact_number' => ['nullable', 'string', 'max:15'],
            'height' => ['nullable', 'numeric'],
            'initial_weight' => ['nullable', 'numeric', 'between:0,999.99'],
            'gender' => ['nullable', 'string', 'max:10'],
            'regular_period' => ['nullable', 'integer', 'min:0'],
            'date_of_last_period' => ['nullable', 'date'],
            'street' => ['nullable', 'string', 'max:255'],
            'house' => ['nullable', 'string', 'max:255'],
            'apartment' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:10'],
            'city' => ['nullable', 'string', 'max:100'],
            'personal_status' => ['nullable', 'string', 'max:100'],
            'occupation' => ['nullable', 'string', 'max:100'],
            'chest' => ['nullable', 'numeric', 'between:0,999.99'],
            'waist' => ['nullable', 'numeric', 'between:0,999.99'],
            'hip' => ['nullable', 'numeric', 'between:0,999.99'],
            'back_pic' => ['nullable', 'image', 'max:2048'],
            'side_pic' => ['nullable', 'image', 'max:2048'],
            'front_pic' => ['nullable', 'image', 'max:2048'],
            'blood_test_report' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:2048'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'contact_number.max' => 'The contact number may not be greater than 15 characters.',
            'height.numeric' => 'The height must be a number.',
            'initial_weight.numeric' => 'The initial weight must be a number.',
            'initial_weight.between' => 'The initial weight must be between 0 and 999.99.',
            // 'age.integer' => 'The age must be an integer.',
            // 'age.min' => 'The age must be at least 0.',
            // 'profile_image.image' => 'The profile picture must be an image file.',
            // 'profile_image.max' => 'The profile picture may not be greater than 2MB.',
            'gender.string' => 'The gender must be a string.',
            'gender.max' => 'The gender field may not be greater than 10 characters.',
            'regular_period.integer' => 'The regular period must be an integer.',
            'regular_period.min' => 'The regular period must be at least 0.',
            'date_of_last_period.date' => 'The date of last period must be a valid date.',
            'street.string' => 'The street must be a string.',
            'street.max' => 'The street field may not be greater than 255 characters.',
            'house.string' => 'The house must be a string.',
            'house.max' => 'The house field may not be greater than 255 characters.',
            'apartment.string' => 'The apartment must be a string.',
            'apartment.max' => 'The apartment field may not be greater than 255 characters.',
            'zipcode.string' => 'The zipcode must be a string.',
            'zipcode.max' => 'The zipcode field may not be greater than 10 characters.',
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city field may not be greater than 100 characters.',
            'personal_status.string' => 'The personal status must be a string.',
            'personal_status.max' => 'The personal status field may not be greater than 100 characters.',
            'occupation.string' => 'The occupation must be a string.',
            'occupation.max' => 'The occupation field may not be greater than 100 characters.',
            'chest.numeric' => 'The chest measurement must be a number.',
            'chest.between' => 'The chest measurement must be between 0 and 999.99.',
            'waist.numeric' => 'The waist measurement must be a number.',
            'waist.between' => 'The waist measurement must be between 0 and 999.99.',
            'hip.numeric' => 'The hip measurement must be a number.',
            'hip.between' => 'The hip measurement must be between 0 and 999.99.',
            'back_pic.image' => 'The back picture must be an image file.',
            'back_pic.max' => 'The back picture may not be greater than 2MB.',
            'side_pic.image' => 'The side picture must be an image file.',
            'side_pic.max' => 'The side picture may not be greater than 2MB.',
            'front_pic.image' => 'The front picture must be an image file.',
            'front_pic.max' => 'The front picture may not be greater than 2MB.',
            'blood_test_report.file' => 'The blood test report must be a file.',
            'blood_test_report.mimes' => 'Only PDF, JPG, JPEG, PNG, DOC, and DOCX files are allowed.',
            'blood_test_report.max' => 'The blood test report may not be greater than 2MB.'
        ];
    }
}
