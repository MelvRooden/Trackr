<?php

namespace App\Http\Requests\Label;

use App\Models\Label;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SetPickupRequest extends FormRequest
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
        $now = Carbon::now();
        $minDate = $now->addDays(2)->setTime(0, 0)->addHours(15);

        return [
            'pickup_datetime' => ['required', "after:$minDate"],
            'pickup_address' => 'required|string',
            'pickup_city' => 'required|string',
            'pickup_postcode' => ['required', 'string', "regex:$this->postcodeRegex"]
        ];
    }
}
