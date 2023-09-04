<?php

namespace App\Abstracts;

use App\Contracts\NotificationDataContract;

/**
 * Данные для отправки оповещения
 */
abstract class NotificationDataDtoAbstract implements NotificationDataContract
{
    /**
     * Получатель (номер телефона/email)
     *
     * @var string
     */
    protected string $receiver = '';

    /**
     * Текст сообщения
     *
     * @var string
     */
    protected string $message = '';

    /**
     * @inheritDoc
     */
    public function setReceiver(string $receiver): void
    {
        $this->receiver = $receiver;
    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return $this->message;
    }

}
