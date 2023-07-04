<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'confirmAdminPassword' => ['required_if:role,super-admin'],
        ];

        if ($this->username !== $this->user->username) {
            $rules['username'] = ['required', 'string', 'max:255', 'unique:' . User::class];
        }

        if ($this->password) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        if ($this->email !== $this->user->email) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:' . User::class];
        }

        return $rules;
    }
}
