<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
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
        $rules = [];

        if ($this->name !== $this->category->name) {
            $rules['name'] = ['required', 'string', 'max:255', Rule::unique(Category::class, 'name')];
        }

        if ($this->slug !== $this->category->slug) {
            $rules['slug'] = ['required', 'string', 'max:255', Rule::unique(Category::class, 'slug')];
        }

        return $rules;
    }
}
