<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ImportFileCSVRequest extends FormRequest
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
            'csv' => "required|mimes:csv,txt",
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