<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;


class RedirectIfNotFilamentAdmin extends Middleware
{
    protected function authenticate($request, array $guards): void
    {
        $auth = Filament::auth();
        $user = $auth->user();
        $panel = Filament::getCurrentPanel();

        if (!($auth->check()
            && $user instanceof FilamentUser
            && $user->canAccessPanel($panel))) {
            Session::flush();
            $this->unauthenticated($request, $guards);
        }
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }
}
