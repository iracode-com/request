<?php
use App\Enums\UserRole;
use App\Interfaces\ISmsHandler;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

function generateTrackingCode()
{
    return time() . '-' . Str::random(10);
}

function pascal_case_to_spaces($string)
{
    return preg_replace('/(?<!^)([A-Z])/', ' \1', $string);
}

function get_users_list()
{
    $users = \App\Models\User::all();
    $users_array = [];
    foreach ($users as $user) {
        $users_array[$user->id] = $user->name;
    }
    return $users_array;
}

function current_user_has_role($roleName)
{
    // return auth()->user()->hasRole($roleName);
    return auth()->user() && auth()->user()->role == $roleName;
}

function current_user_is_admin()
{
    // return auth()->user()->hasRole($roleName);
    return auth()->user() && (auth()->user()->role == UserRole::ADMIN || auth()->user()->role == UserRole::SUPERADMIN);
}

function pascalToTitle($string)
{
    $result = preg_replace('/([a-z])([A-Z])/', '$1 $2', $string);
    return ucwords($result);
}


function send_request_notification(Model $model, string $message, User | Authenticatable $user)
{
    if(app()->environment() == 'production'){
        $smsHandler = app(ISmsHandler::class);
        $smsHandler->sendSms(null, $user->mobile, $message);
    }
    else{
        info($user->mobile, [$message]);
    }
    Notification::make()
        ->title(__("System Message"))
        ->body($message)
        ->sendToDatabase($user);
    return true;
}

function send_request_notification_and_pattern_sms(Model $model, User | Authenticatable $user, string $message, array $params, string $bodyId)
{
    if(app()->environment() == 'production'){
        $smsHandler = app(ISmsHandler::class);
        $smsHandler->sendSmsByPattern(
            $user->mobile, 
        $params,
        $bodyId
    );
    }
    else{
        info($user->mobile, [$message]);
    }
    Notification::make()
        ->title(__("System Message"))
        ->body($message)
        ->sendToDatabase($user);
    return true;
}