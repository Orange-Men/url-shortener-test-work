<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShortLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'link' => ['required', 'url'],
            'redirection_limit' => ['bail', 'required', 'integer', 'gte:0', 'max:999999999'],
            'lifetime_limit' => ['bail', 'required', 'integer', 'max:24'],
        ];
    }
}
