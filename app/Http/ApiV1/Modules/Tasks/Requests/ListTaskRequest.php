<?php

namespace App\Http\ApiV1\Modules\Tasks\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ListTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'data'=>[],
            'errors' => [
                'code' => 'ValidationError',
                'message' => [
                    $validator->errors()
                ],
            'meta' => []
            ]
        ], 422));
    }
}
