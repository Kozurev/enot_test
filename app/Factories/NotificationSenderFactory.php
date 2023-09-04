<?php

namespace App\Factories;

use App\Contracts\NotificationSenderContract;
use App\Enums\NotificationTypeEnum;
use App\Services\Senders\EmailSender;
use App\Services\Senders\SmsSender;
use App\Services\Senders\TelegramSender;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

class NotificationSenderFactory
{
    /**
     * @param Container $container
     */
    public function __construct(
        protected readonly Container $container
    ) {}

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function build(NotificationTypeEnum $notificationType): ?NotificationSenderContract
    {
        $senderClass = match ($notificationType) {
            NotificationTypeEnum::EMAIL => EmailSender::class,
            NotificationTypeEnum::SMS => SmsSender::class,
            NotificationTypeEnum::TELEGRAM => TelegramSender::class,
            default => null
        };

        return !is_null($senderClass)
            ? $this->container->make($senderClass)
            : null;
    }
}
