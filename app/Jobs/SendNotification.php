<?php

namespace App\Jobs;

use App\Enums\NotificationTypeEnum;
use App\Factories\NotificationDataDtoFactory;
use App\Factories\NotificationSenderFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Отправка сообщения пользователю
 */
class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected NotificationTypeEnum $notificationType,
        protected string $receiver,
        protected string $message,
        protected ?string $subject = null
    ) {}

    /**
     * Execute the job.
     * @throws BindingResolutionException
     */
    public function handle(
        NotificationSenderFactory $notificationSenderFactory,
        NotificationDataDtoFactory $notificationDataDtoFactory
    ): void {
        $notificationData = $notificationDataDtoFactory->build(
            $this->notificationType,
            $this->receiver,
            $this->message,
            $this->subject
        );
        $notificationSender = $notificationSenderFactory->build($this->notificationType);
        if (!is_null($notificationSender)) {
            $notificationSender->send($notificationData);
        }
    }
}
