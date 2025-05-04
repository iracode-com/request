<?php
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
    return auth()->user()->role == $roleName;
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