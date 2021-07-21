<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ConfigsController;
use Hos3ein\NovelAuth\Features\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SessionConfig
{
    public function handle(Request $request, $next)
    {
        $configs = Session::get(ConfigsController::$SessionConfigs, []);

        if (array_key_exists(Constants::$otpServices, $configs))
            Config::set(Constants::$configOtpServices, $configs[Constants::$otpServices]);

        if (array_key_exists(Constants::$registerMethods, $configs))
            Config::set(Constants::$configRegisterMethods, $configs[Constants::$registerMethods]);

        if (array_key_exists(Constants::$registerPhoneOptServices, $configs))
            Config::set(Constants::$configRegisterPhoneOptServices, $configs[Constants::$registerPhoneOptServices]);

        if (array_key_exists(Constants::$registerMode, $configs))
            Config::set(Constants::$configRegisterMode, $configs[Constants::$registerMode]);

        if (array_key_exists(Constants::$loginMode, $configs))
            Config::set(Constants::$configLoginMode, $configs[Constants::$loginMode]);


        return $next($request);
    }
}
