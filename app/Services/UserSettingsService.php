<?php

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\UserSetting;

class UserSettingsService
{
    /**
     * Изменение настройки с типом
     *
     * @param int $userId
     * @param NotificationTypeEnum $notificationTypeEnum
     * @return UserSetting
     */
    public function updateNotificationType(int $userId, NotificationTypeEnum $notificationTypeEnum): UserSetting
    {
        return UserSetting::byUser($userId)->updateOrCreate([
            'notification_type' => $notificationTypeEnum
        ]);
    }
}
