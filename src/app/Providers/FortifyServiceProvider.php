<?php

namespace App\Providers;

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\RegisterController;
use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\RegisterResponse as ContractsRegisterResponse;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(RegisterController::class);

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        // RateLimiter::for('login', function (Request $request) {
        //     $email = (string) $request->email;
        //     return Limit::perMinute(10)->by($email . $request->ip());
        // });

        $this->app->singleton(FortifyLoginRequest::class, function ($app) {
            return $app->make(LoginRequest::class);
        });

        // Fortify::authenticateUsing(function (LoginRequest $request) {
        //     $user = User::where('email', $request->email)->first();

        //     if (
        //         $user &&
        //         Hash::check($request->password, $user->password)
        //     ) {
        //         return $user;
        //     }
        // });
    }
}