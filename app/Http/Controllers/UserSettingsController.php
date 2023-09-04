<?php

namespace App\Http\Controllers;

use App\Enums\NotificationTypeEnum;
use App\Http\Requests\UserSettings\UpdateNotificationTypeRequest;
use App\Services\UserSettingsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserSettingsController extends Controller
{
    /**
     * Общий раздел настроек
     *
     * @return View
     */
    public function index(): View
    {
        return view('');
    }

    /**
     * Изменения настройки типиа оповещения пользователя
     *
     * @param UpdateNotificationTypeRequest $request
     * @return RedirectResponse
     */
    public function updateNotificationType(UpdateNotificationTypeRequest $request): RedirectResponse
    {
        // Запоминаем значение найстройки для дальнейшего сохранения
        $request->session()->put('user.setting.notificationType', $request->notification_type);

        return redirect(route('confirmation.form'));
    }

    /**
     * Сохранение значения настройки
     *
     * @param Request $request
     * @param UserSettingsService $settingsService
     * @return RedirectResponse
     */
    public function updateNotificationTypeSubmit(Request $request, UserSettingsService $settingsService): RedirectResponse
    {
        $redirectResponse = redirect(route('user.settings.index'));

        // Проверяем наличие подтверждающего флага верификации при помощи одноразового кода
        if (!$request->session()->exists('code_confirmed')) {
            return $redirectResponse->withErrors([
                'confirmation_code' => __('confirmation.verification_required') // Для изменения типа оповещений необходимо пройти верификацию при помощи одноразового кода
            ]);
        }
        // Проверяем наличие значения настройки, так как сессия могла истечь
        if (!$request->session()->exists('user.setting.notificationType')) {
            return $redirectResponse->withErrors([
                'notification_type' => __('settings.notification_type_required') // Сохраняемое значение найстройки не найдено. Попробуйте снова
            ]);
        }

        // Сохраняем новое значение настройки
        $settingsService->updateNotificationType(
            $request->user()->id,
            NotificationTypeEnum::tryFrom($request->session()->get('user.setting.notificationType'))
        );

        // Удаляем флаг подтверждения одноразового кода и значение настройки из сессии
        $request->session()->forget('code_confirmed');
        $request->session()->forget('user.setting.notificationType');

        return redirect(route('user.settings.index'))->with([
            'success' => true,
            'message' => __('settings.notification_type_changed_successful') // Тип оповещений успешно изменен
        ]);
    }
}
