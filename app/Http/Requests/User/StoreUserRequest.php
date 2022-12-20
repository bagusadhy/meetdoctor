<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Validation\Rules\Password;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if return true, the function will automatically pass the request, so we will use middleware to check if the request is true or false
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'string|max:255|mixedCase', Password::min(8)->mixedCase(),
        ];
    }
}
