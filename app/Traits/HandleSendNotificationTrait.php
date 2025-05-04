<?php
namespace App\Traits;

use App\Enums\UserRequestState;
use App\Models\UserRequest;
use App\Models\UserRequestResponse;
use Filament\Notifications\Notification;
use App\Interfaces\ISmsHandler;

trait HandleSendNotificationTrait
{
    protected static function bootHandleSendNotificationTrait()
    {
        static::created(function ($model) {
            if (is_a($model, UserRequest::class)) {
                if ($model->user) {
                    $message = __("Your request has been registered with tracking code:") . " " . $model->tracking_code;
                    send_request_notification($model, $message, $model->user);
                }
            }
            else if (is_a($model, UserRequestResponse::class)) {
                if ($model->userRequest?->user) {
                    $message = __("New response has been registered for your request with tracking code:") . " " . $model->userRequest?->tracking_code;
                    send_request_notification($model, $message, $model->userRequest?->user);
                }
            }
        });
        static::updated(function ($model) {
            if (is_a($model, UserRequest::class)) {
                if ($model->status == UserRequestState::APPROVED) {
                    $message = __("Your request has been approved with tracking code:") . " " . $model->tracking_code;
                    send_request_notification($model, $message, $model->user);
                } else if ($model->status == UserRequestState::REJECTED) {
                    $message = __("Your request has been rejected with tracking code:") . " " . $model->tracking_code;
                    send_request_notification($model, $message, $model->user);
                } else if ($model->status == UserRequestState::CLOSED) {
                    $message = __("Your request has been closed with tracking code:") . " " . $model->tracking_code;
                    send_request_notification($model, $message, $model->user);
                }
            }
        });
    }
}
