<?php

namespace App\Contracts;

/**
 * Интерфейс для DTO с данными для отправки оповещения
 */
interface NotificationDataContract
{
    /**
     * @param string $receiver
     * @return void
     */
    public function setReceiver(string $receiver): void;

    /**
     * Данные получателя (номер телефона/email)
     *
     * @return string
     */
    public function getReceiver(): string;

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void;

    /**
     * Текст оповещения
     *
     * @return string
     */
    public function getMessage(): string;

}
