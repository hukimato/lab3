<?php

namespace App\Http\ApiV1\Modules\Tasks\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PatchTaskRequest extends FormRequest
{
    public function rules(): array 
    {
        return [
            'content' => ['string', 'required_without_all:is_done,list_id'],
            'is_done' => ['boolean','required_without_all:content,list_id'],
            'list_id' => ['integer', 'required_without_all:is_done,content'],
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
