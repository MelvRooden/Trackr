<?php

namespace App\Http\Requests\Label;

use App\Models\Label;
use App\Models\Role;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public string $postcodeRegex = '/^[1-9][0-9]{3}[\s]?[A-Za-z]{2}$/i';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Label::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'carrier_name' => ['required', 'string', Rule::exists('users', 'name')->where('role_id', 3)],

            'receiver_address' => 'required|string',
            'receiver_city' => 'required|string',
            'receiver_postcode' => ['required', 'string', "regex:$this->postcodeRegex"]
        ];
    }
}
