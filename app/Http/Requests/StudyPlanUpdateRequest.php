<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudyPlanUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'major_id' => ['required', 'exists:majors,id'],
            'degree_level' => ['required', Rule::in(['bachelor', 'master', 'doctorate'])],
            'year' => ['required', 'integer', 'min:2024', 'max:2026'],
        ];
    }
}
