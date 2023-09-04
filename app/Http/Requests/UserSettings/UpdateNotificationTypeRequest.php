<?php

namespace App\Http\Requests\UserSettings;

use App\Enums\NotificationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $notification_type
 */
class UpdateNotificationTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'notification_type' => ['required', Rule::in(NotificationTypeEnum::values())]
        ];
    }
}
