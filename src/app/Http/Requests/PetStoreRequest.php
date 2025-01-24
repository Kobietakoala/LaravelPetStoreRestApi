<?php

namespace App\Http\Requests;

use App\Enum\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'photoUrls' => 'required|array',
            'photoUrls.*' => 'url',
            'status' => [Rule::enum(StatusEnum::class), 'nullable'],
            'category' => 'nullable|array',
            'tag' => 'nullable|array'
        ];
    }
}
