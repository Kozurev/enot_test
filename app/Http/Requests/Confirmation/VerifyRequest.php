<?php

namespace App\Http\Requests\Confirmation;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $code
 */
class VerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'integer', 'min:1']
        ];
    }
}
