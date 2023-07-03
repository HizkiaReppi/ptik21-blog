<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'not_in:choose'],
            'content' => ['required'],
            'image' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:1024'],
        ];

        if ($this->slug !== $this->post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function messages(): array
    {
        return [
            'category_id.not_in' => 'The category field is required.',
        ];
    }
}
