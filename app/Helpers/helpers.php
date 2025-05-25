<?php
use App\Enums\UserRole;
use App\Interfaces\ISmsHandler;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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


function send_request_notification(Model $model, string $message, User|Authenticatable $user)
{
    if (app()->environment() == 'production') {
        $smsHandler = app(ISmsHandler::class);
        $smsHandler->sendSms(null, $user->mobile, $message);
    } else {
        info($user->mobile, [$message]);
    }
    Notification::make()
        ->title(__("System Message"))
        ->body($message)
        ->sendToDatabase($user);
    return true;
}

function send_request_notification_and_pattern_sms(Model $model, User|Authenticatable $user, string $message, array $params, string $bodyId)
{
    if (app()->environment() == 'production') {
        $smsHandler = app(ISmsHandler::class);
        $smsHandler->sendSmsByPattern(
            $user->mobile,
            $params,
            $bodyId
        );
    } else {
        info($user->mobile, [$message]);
    }
    Notification::make()
        ->title(__("System Message"))
        ->body($message)
        ->sendToDatabase($user);
    return true;
}

function get_latest_assets()
{
    $assetsPath = public_path('build/assets');
    $cssFile = null;
    $jsFile = null;

    if (File::isDirectory($assetsPath)) {
        $files = File::files($assetsPath);

        foreach ($files as $file) {
            if ($file->getExtension() === 'css') {
                if (!$cssFile || $file->getMTime() > $cssFile->getMTime()) {
                    $cssFile = $file;
                }
            }

            if ($file->getExtension() === 'js') {
                if (!$jsFile || $file->getMTime() > $jsFile->getMTime()) {
                    $jsFile = $file;
                }
            }
        }
    }

    return [
        'css' => $cssFile ? asset('build/assets/' . $cssFile->getFilename()) : null,
        'js' => $jsFile ? asset('build/assets/' . $jsFile->getFilename()) : null,
    ];
}


function extract_reset_password_query_params(string $url)
{

    $parsedUrl = parse_url($url);
    $queryString = $parsedUrl['query'] ?? '';

    parse_str($queryString, $params);

    $email = $params['email'] ?? null;
    $token = $params['token'] ?? null;
    $signature = $params['signature'] ?? null;

    if ($email && $token && $signature) {
        return [
            "email"=> $email,
            "token"=> $token,
            "signature"=> $signature,
        ];
    }
    return [];
}


function remove_query_param($url, $paramToRemove) {
    $parsedUrl = parse_url($url);
    
    if (!isset($parsedUrl['query'])) {
        return $url; // No query string, return original URL
    }
    
    // Parse query string into array
    parse_str($parsedUrl['query'], $params);
    
    // Remove the specified parameter
    unset($params[$paramToRemove]);
    
    // Rebuild the URL
    $newQuery = http_build_query($params);
    
    // Reconstruct the full URL
    $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
    $host = $parsedUrl['host'] ?? '';
    $port = isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '';
    $path = $parsedUrl['path'] ?? '';
    $query = $newQuery ? '?' . $newQuery : '';
    $fragment = isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '';
    
    return $scheme . $host . $port . $path . $query . $fragment;
}