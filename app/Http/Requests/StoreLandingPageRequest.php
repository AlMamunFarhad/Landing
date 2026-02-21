<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLandingPageRequest extends FormRequest
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
        $landingPageId = $this->route('page')?->id; // je param route e pathano hocche

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('landing_pages', 'slug')->ignore($landingPageId),
            ],
            'is_published' => 'sometimes|boolean',
            'button_text' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',

            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_youtube_link' => 'nullable|string|max:1000',

            'product_title' => 'nullable|string|max:255',
            'product_subtitle' => 'nullable|numeric',
            'product_image' => 'nullable|image|max:4096',

            'why_trust_us_title' => 'nullable|string|max:255',
            'why_trust_us_description' => 'nullable|string',
            'why_trust_us_image' => 'nullable|image|max:4096',

            'why_choose_title' => 'nullable|string|max:255',
            'why_choose_description' => 'nullable|string',

            'product_ids' => 'nullable|string',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_published' => $this->has('is_published') ? boolval($this->input('is_published')) : false,
        ]);
    }
}
