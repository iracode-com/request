<?php

use Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', fn() => redirect()->intended(Dashboard::getUrl()));

// to fix "Route [login] not defined."
Route::get('/login', fn() => redirect()->intended(filament()->getLoginUrl()))->name('login');

Route::controller(AuthController::class)
    ->prefix('auth/sso')
    ->name('auth.sso.')
    ->group(function () {
        Route::get('/login', 'redirect')->name('login');
        Route::get('/callback', 'callback')->name('callback');
    });

Route::get('artisan-storage-link', fn() => Artisan::call('storage:link'));
Route::get('artisan-filament-optimize', fn() => Artisan::call('filament:optimize'));
Route::get('artisan-filament-optimize-clear', fn() => Artisan::call('filament:optimize-clear'));
Route::get('artisan-filament-cache-components', fn() => Artisan::call('filament:cache-components'));
Route::get('artisan-filament-cache-components-clear', fn() => Artisan::call('filament:clear-cached-components'));
Route::get('artisan-filament-icons-cache', fn() => Artisan::call('icons:cache'));
Route::get('artisan-optimize', fn() => Artisan::call('optimize'));
Route::get('artisan-optimize-clear', fn() => Artisan::call('optimize:clear'));

Route::get('migrate-and-seed',function(){
    if(request()->query('secret') != 'adnalsdnsldsandio3hodna'){
        abort(404);
    }
    Artisan::call('migrate --seed');
    dd(Artisan::output());
});