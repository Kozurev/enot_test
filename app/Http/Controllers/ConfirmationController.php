<?php

namespace App\Http\Controllers;

use App\Enums\NotificationTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Confirmation\ConfirmRequest;
use App\Http\Requests\Confirmation\VerifyRequest;
use App\Jobs\SendNotification;
use App\Services\ConfirmationCodesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер для подтверждения действий при помощи одноразовых кодов
 */
class ConfirmationController extends Controller
{
    /**
     * Форма с выбором способов получения одноразового кода
     * Форма ведет на confirmation.confirm
     *
     * @return View
     */
    public function confirmationForm(): View
    {
        return view('');
    }

    /**
     * Подтверждение одноразового кода
     * Тут форма с вводом кода, который пришел на почту / в смс / в телеграм
     * ведет на confirmation.verify
     *
     * @param ConfirmRequest $request
     * @param ConfirmationCodesService $confirmationCodesService
     * @return View
     * @throws \Exception
     */
    public function confirm(ConfirmRequest $request, ConfirmationCodesService $confirmationCodesService): View
    {
        $code = $confirmationCodesService->getCodeForUser($request->user()->id);

        SendNotification::dispatch(
            NotificationTypeEnum::tryFrom($request->verification_type),
            $request->recipient,
            __('confirmation.message', [
                'code' => $code->code,
                'expired_at' => $code->expired_at
            ]),
            __('confirmation.subject')
        );

        return view('');
    }

    /**
     * Подтверждение кода из оповещения и редирект либо назад, либо на страницу с сохранением настройки
     *
     * @param VerifyRequest $request
     * @param ConfirmationCodesService $confirmationCodesService
     * @return RedirectResponse
     */
    public function verify(VerifyRequest $request, ConfirmationCodesService $confirmationCodesService): RedirectResponse
    {
        if (!$confirmationCodesService->verify($request->user()->id, $request->code)) {
            return redirect()->back();
        }

        $request->session()->put('code_confirmed', 1);

        return redirect(route('user.settings.update.notificationType.submit'));
    }

}
