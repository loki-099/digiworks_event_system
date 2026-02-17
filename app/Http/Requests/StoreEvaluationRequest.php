<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
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
            'token'    => 'required|string',
            'email'    => 'required|email',
            'rating'   => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'token.required'  => 'The QR code token is missing.',
            'email.required'  => 'Please enter your email address.',
            'email.email'     => 'Please enter a valid email address.',
            'rating.required' => 'Please select a rating.',
            'rating.integer'  => 'The rating must be a number.',
            'rating.min'      => 'The rating must be at least 1.',
            'rating.max'      => 'The rating cannot exceed 5.',
            'comments.max'    => 'Comments cannot exceed 1000 characters.',
        ];
    }
}