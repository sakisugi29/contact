<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
{
    Fortify::createUsersUsing(CreateNewUser::class);

    Fortify::redirects('failed-registration', '/register');

    Fortify::registerView(function () {
        return view('auth.register');
    });

    Fortify::loginView(function () {
        return view('auth.login');
    });

    Fortify::authenticateUsing(function (Request $request) {
        $loginRequest = new LoginRequest();

        Validator::make(
            $request->all(),
            $loginRequest->rules(),
            $loginRequest->messages(),
            $loginRequest->attributes()
        )->validate();

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return Auth::user();
        }

        throw ValidationException::withMessages([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ]);
    });

    RateLimiter::for('login', function (Request $request) {
        return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by(
            Str::lower($request->input(Fortify::username())) . '|' . $request->ip()
        );
    });
}

}