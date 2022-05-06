<?php

namespace App\Http\ApiV1\Modules\Tasks\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ListTaskRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['take' => $this->route('take')]);
        $this->merge(['skip' => $this->route('skip')]);
        $this->merge(['list_id' => $this->route('list_id')]);
    }

    public function rules(): array
    {
        return [
            'take' => 'integer',
            'skip' => 'integer',
            'list_id' => ['integer', 'required', 'exists:my_lists,id']
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
