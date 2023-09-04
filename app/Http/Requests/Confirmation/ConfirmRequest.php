<?php

namespace App\Http\Requests\Confirmation;

use App\Enums\NotificationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $verification_type
 * @property-read string $recipient
 */
class ConfirmRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'verification_type' => ['required', Rule::in(NotificationTypeEnum::values())],
            'recipient' => ['required', 'string']
        ];
    }
}
