<?php

namespace App\Services\Senders;

use App\Contracts\NotificationDataContract;
use App\Contracts\NotificationSenderContract;
use Illuminate\Support\Facades\Log;

class TelegramSender implements NotificationSenderContract
{
    /**
     * @inheritDoc
     */
    public function send(NotificationDataContract $notificationData): void
    {
        Log::debug('Получатель: ' . $notificationData->getReceiver()
            . '; Сообщение: ' . $notificationData->getMessage()
        );
    }
}
