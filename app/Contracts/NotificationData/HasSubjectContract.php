<?php

namespace App\Contracts\NotificationData;

/**
 * Интерфейс для DTO оповещений по email
 */
interface HasSubjectContract
{
    /**
     * @param string $subject
     * @return void
     */
    public function setSubject(string $subject): void;

    /**
     * @return string
     */
    public function getSubject(): string;
}
