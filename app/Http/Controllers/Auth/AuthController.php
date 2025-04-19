<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $service) {}

    public function redirect(Request $request)
    {
        return $this->service->redirectToProvider($request);
    }

    public function callback(Request $request)
    {
        return $this->service->handleProviderCallback($request);
    }
}
