<?php

namespace App\Http\ApiV1\Modules\MyLists\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ListMyListRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['take' => $this->route('take')]);
        $this->merge(['skip' => $this->route('skip')]);
    }

    public function rules(): array
    {
        return [
            'take' => 'integer',
            'skip' => 'integer',
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
