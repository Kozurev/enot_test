<?php

namespace App\Enums;

use Illuminate\Support\Collection;

/**
 * Типы оповещений
 */
enum NotificationTypeEnum: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
    case TELEGRAM = 'telegram';

    /**
     * @return Collection
     */
    public static function values(): Collection
    {
        return collect(self::cases())->map(static fn (self $case) => $case->value);
    }
}
