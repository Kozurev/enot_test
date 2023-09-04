<?php

namespace App\Services;

use App\Models\ConfirmationCode;
use Illuminate\Support\Carbon;

/**
 * Сервис для работы с одноразовыми кодами
 */
class ConfirmationCodesService
{
    /**
     * Время в минутах когда код еще считается активным
     */
    public const EXPIRATION_CODE_MINUTES = 60;

    /**
     * Проверка кода подтверждения
     *
     * @param int $userId
     * @param string $code
     * @return bool
     */
    public function verify(int $userId, string $code): bool
    {
        /** @var ConfirmationCode|null $confirmationCode */
        $confirmationCode = ConfirmationCode::byUser($userId)
            ->byCode($code)
            ->notConfirmed()
            ->notExpired()
            ->first();
        if (is_null($confirmationCode)) {
            return false;
        }

        $confirmationCode->confirmed = 1;
        $confirmationCode->save();

        return true;
    }

    /**
     * Создания нового кода подтверждения для пользователя
     *
     * @param int $userId
     * @return ConfirmationCode
     * @throws \Exception
     */
    public function getCodeForUser(int $userId): ConfirmationCode
    {
        /** @var ConfirmationCode|null $confirmationCode */
        $confirmationCode = ConfirmationCode::byUser($userId)
            ->notConfirmed()
            ->notExpired()
            ->first();
        if (!is_null($confirmationCode)) {
            return $confirmationCode;
        }

        return $this->createNewConfirmationCode($userId, $this->generateCode());
    }

    /**
     * @param int $userId
     * @param string $code
     * @return ConfirmationCode
     */
    protected function createNewConfirmationCode(int $userId, string $code): ConfirmationCode
    {
        $confirmationCode = new ConfirmationCode();
        $confirmationCode->user_id = $userId;
        $confirmationCode->code = $code;
        $confirmationCode->expired_at = now()->addMinutes(self::EXPIRATION_CODE_MINUTES);
        $confirmationCode->save();

        return $confirmationCode;
    }

    /**
     * Генерация нового кода
     *
     * @return string
     * @throws \Exception
     */
    protected function generateCode(): string
    {
        return random_int(1000, 9999);
    }
}
