<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ShortenCreateRequest extends FormRequest
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
            'url' => 'required|url',
            'hits' => 'integer',
            'max_hits' => 'integer',
            'expires_at' => 'date'
        ];
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => (new ValidationException($validator))->errors()
            ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json([
                'error' => (new AuthorizationException())->getMessage()
            ],
                JsonResponse::HTTP_FORBIDDEN
            )
        );
    }
}
