<?php

namespace App\Services\Senders;

use App\Contracts\NotificationData\HasSubjectContract;
use App\Contracts\NotificationDataContract;
use App\Contracts\NotificationSenderContract;
use Illuminate\Support\Facades\Log;

class EmailSender implements NotificationSenderContract
{
    /**
     * @inheritDoc
     */
    public function send(NotificationDataContract|HasSubjectContract $notificationData): void
    {
        Log::debug('Получатель: ' . $notificationData->getReceiver()
            . '; Тема: ' . $notificationData->getSubject()
            .'; Сообщение: ' . $notificationData->getMessage()
        );
    }
}
