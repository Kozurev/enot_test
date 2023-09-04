<?php

namespace App\Factories;

use App\Classes\Notifications\Extended\EmailNotificationDto;
use App\Classes\Notifications\NotificationDataDto;
use App\Contracts\NotificationData\HasSubjectContract;
use App\Contracts\NotificationDataContract;
use App\Enums\NotificationTypeEnum;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

class NotificationDataDtoFactory
{
    /**
     * @param Container $container
     */
    public function __construct(
        protected readonly Container $container
    ) {}

    /**
     * @param NotificationTypeEnum $notificationType
     * @param string $receiver
     * @param string $message
     * @param string|null $subject
     * @return NotificationDataContract
     * @throws BindingResolutionException
     */
    public function build(
        NotificationTypeEnum $notificationType,
        string $receiver,
        string $message,
        ?string $subject = null
    ): NotificationDataContract {
        $senderDtoClass = match ($notificationType) {
            NotificationTypeEnum::EMAIL => EmailNotificationDto::class,
            default => NotificationDataDto::class
        };

        /** @var NotificationDataContract $notificationDto */
        $notificationDto = $this->container->make($senderDtoClass);
        $notificationDto->setReceiver($receiver);
        $notificationDto->setMessage($message);
        if (!is_null($subject) && $notificationDto instanceof HasSubjectContract) {
            $notificationDto->setSubject($subject);
        }

        return $notificationDto;
    }
}
