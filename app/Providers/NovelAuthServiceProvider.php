<?php

namespace App\Providers;

use Hos3ein\NovelAuth\Classes\AccountManager;
use App\Actions\NovelAuth\OtpManager;
use Hos3ein\NovelAuth\Classes\TM;
use Hos3ein\NovelAuth\NovelAuth;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Rules\Password;

class NovelAuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (request()->isAdmins()) {
            config(['novel-auth.guard' => 'admins']);
            config(['novel-auth.prefix' => 'admins']);
            config(['novel-auth.home' => 'admins/dashboard']);
            NovelAuth::viewPrefix('auth.admins.');
        } else {
            NovelAuth::viewPrefix('novel-auth::bootstrap.');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // NovelAuth::ignoreRoutes();
        NovelAuth::accountManagerUsing(AccountManager::class);
        NovelAuth::otpManagerUsing(OtpManager::class);

        // NovelAuth::customPassValidationRule((new Password())->length(1));

        /*NovelAuth::emailPhoneValidationUsing(function ($emailPhone) {
            if (is_numeric($emailPhone))
                return array(preg_match("/^(\+\d{1,3})+\d{10}$/", $emailPhone), Constants::$PHONE_MODE);
            else
                return array(filter_var($emailPhone, FILTER_VALIDATE_EMAIL), Constants::$EMAIL_MODE);
        });*/

        /*NovelAuth::incompleteEmailPhoneUsing(function ($otpType, $emailPhone) {
            return substr($emailPhone, 0, 1) . '***' . substr($emailPhone, -1, 1);
        });*/

        RateLimiter::for('auth', function (Request $request) {
            if ($request->token_rc)
                $identifier = TM::ParseToken($request->token_rc)->getClaim('email_phone', '');
            else
                $identifier = $request->email_phone;

            return Limit::perMinute(20)->by($identifier . $request->ip());
        });

        /*NovelAuth::onAuthDone(function (Request $request, $user) {
            if (config(Constants::$configGuard) == 'api-jwt') {
                $token = auth('api-jwt')->login($user);
                return response()->json([
                    'user' => auth('api-jwt')->user(),
                    'token' => $token,
                    'message' => 'welcome',
                    'next_page' => 'home',
                ]);
            } else {
                // session base
                auth(config(Constants::$configGuard))->login($user, $request->filled('remember'));
                $token = auth(config(Constants::$configGuard))->user()->getRememberToken();
                return response()->redirectTo(config(Constants::$configHome));
            }
        });*/
    }
}
