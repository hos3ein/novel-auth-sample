<?php

namespace App\Http\Controllers;

use Hos3ein\NovelAuth\Features\Constants;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class ConfigsController extends BaseController
{
    public static $SessionConfigs = 'session_configs';

    // Session based configs. Just for test NovelAuth package.
    public function index()
    {
        return view('configs');
    }

    public function store(Request $request)
    {
        $configs = [];
        // validate request

        $defaultOtpServices = [Constants::$OTP_EMAIL, Constants::$OTP_CALL, Constants::$OTP_SMS, Constants::$OTP_USSD, Constants::$OTP_TELEGRAM, Constants::$OTP_WHATSAPP, Constants::$OTP_GENERATOR];
        $input = $request->input(Constants::$otpServices, $defaultOtpServices);
        $otpServices = [];
        foreach ($defaultOtpServices as $method)
            if (in_array($method, $input))
                $otpServices[] = $method;
        if (count($input) == 1 and $input[0] == 'empty')
            $otpServices = [];
        $configs[Constants::$otpServices] = $otpServices;

        $defaultRegisterMethods = [Constants::$EMAIL_MODE, Constants::$PHONE_MODE];
        $input = $request->input(Constants::$registerMethods, $defaultRegisterMethods);
        $registerMethods = [];
        foreach ($defaultRegisterMethods as $method)
            if (in_array($method, $input))
                $registerMethods[] = $method;
        if (count($input) == 1 and $input[0] == 'd')
            $registerMethods = [];
        $configs[Constants::$registerMethods] = $registerMethods;

        $defaultRegisterPhoneOtpServices = [Constants::$OTP_CALL, Constants::$OTP_SMS, Constants::$OTP_USSD];
        $input = $request->input(Constants::$registerPhoneOptServices, $defaultRegisterPhoneOtpServices);
        $registerPhoneOptServices = [];
        foreach ($defaultRegisterPhoneOtpServices as $method)
            if (in_array($method, $input))
                $registerPhoneOptServices[] = $method;
        if (count($input) == 1 and $input[0] == 'empty')
            $registerPhoneOptServices = [];
        $configs[Constants::$registerPhoneOptServices] = $registerPhoneOptServices;

        $registerMode = $request->input(Constants::$registerMode, Constants::$CP_CODE_PASSWORD);
        if (!in_array($registerMode, [Constants::$CP_CODE_PASSWORD, Constants::$CP_ONLY_CODE, Constants::$CP_ONLY_PASSWORD]))
            $registerMode = Constants::$CP_CODE_PASSWORD;
        $configs[Constants::$registerMode] = $registerMode;

        $loginMode = $request->input(Constants::$loginMode, Constants::$OPTIONAL_PASSWORD_CODE);
        if (!in_array($loginMode, [Constants::$ONLY_PASSWORD, Constants::$ONLY_CODE, Constants::$PASSWORD_CODE, Constants::$CODE_PASSWORD, Constants::$OPTIONAL_PASSWORD_CODE, Constants::$OPTIONAL_CODE_PASSWORD]))
            $loginMode = null;
        $configs[Constants::$loginMode] = $loginMode;

        Session::put(self::$SessionConfigs, $configs);
        return redirect()->route('configs');
    }
}
