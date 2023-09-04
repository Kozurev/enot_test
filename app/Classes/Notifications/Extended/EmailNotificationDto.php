<?php

namespace App\Classes\Notifications\Extended;

use App\Abstracts\NotificationDataDtoAbstract;
use App\Contracts\NotificationData\HasSubjectContract;

/**
 * DTO с данными для отправки email оповещения
 */
class EmailNotificationDto extends NotificationDataDtoAbstract implements HasSubjectContract
{
    /**
     * Тема сообщения
     *
     * @var string
     */
    protected string $subject = '';

    /**
     * @param string $subject
     * @return void
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

}
