<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return false;
        if (Auth::user()->isSuperAdmin()) return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'email' => 'required|string|email|unique:users|max:120',
            'password' => 'required|string|max:80',
            'address' => 'required|string|max:80',
            'city' => 'required|string|max:80',
            'postcode' => 'required|string|max:10',
            'role_id' => 'required|int',
        ];
    }
}
