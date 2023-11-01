<?php

namespace App\Http\Requests\API\v1;

use App\Enum\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'name' => ['max:30'],
            'username' => ['unique:users,username', 'max:20'],
            'password' => [Password::min(8)->mixedCase()->numbers()->symbols()],
        ];
    }
}
