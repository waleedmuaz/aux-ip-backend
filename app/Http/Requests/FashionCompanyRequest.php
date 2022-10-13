<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FashionCompanyRequest extends FormRequest
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
            "reference"=>'required',
            "ip_type"=>'required',
            "application"=>'required',
            "application_numbers"=>'required',
            "application_filing_date"=>'required',
            "patent_numbers"=>'required',
            "grant_date"=>'required',
            "country"=>'required',
            "due_date"=>'required',
            "last_instruction_date"=>'required',
            "estimated_cost"=>'required',
            "instruction"=>'required',
            "user_id"=>'required',
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        foreach ($validator->messages()->getMessages() as $key =>   $message){
            $messages[$key]     =   $message[0];
        }
        $response = jsonFormat(false,$messages,"The given data was invalid.");
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
