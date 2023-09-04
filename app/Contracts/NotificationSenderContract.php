<?php

namespace App\Contracts;

use App\Abstracts\NotificationDataDtoAbstract;

interface NotificationSenderContract
{
    /**
     * Отправка сообщения
     *
     * @param NotificationDataContract $notificationData
     * @return void
     */
    public function send(NotificationDataContract $notificationData): void;
}
