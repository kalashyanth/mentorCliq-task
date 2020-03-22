<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchingPercentageRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'division' => 'required',
            'age' => 'required',
            'timezone' => 'required',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (collect($this->all())->sum() === 100) {
                $validator->errors()->add('sum', 'The sum of these values must be equal to 100%');
            }
        });
    }
}
