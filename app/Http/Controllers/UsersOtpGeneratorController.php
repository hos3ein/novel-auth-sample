<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

class UsersOtpGeneratorController extends BaseController
{
    public function index(Request $request)
    {
        if (is_null($request->user()->two_factor_secret)) {
            $qrcodeUrl = null;
            $qrcode = null;
            $recoveryCodes = null;
        } else {
            $qrcodeUrl = $request->user()->twoFactorQrCodeUrl();
            $qrcode = $request->user()->twoFactorQrCodeSvg();
            $recoveryCodes = $request->user()->recoveryCodes();
        }
        return view('otp_generator', compact('qrcode', 'qrcodeUrl', 'recoveryCodes'));
    }

    public function store(Request $request)
    {
        if (is_null($request->user()->two_factor_secret)) {
            app(EnableTwoFactorAuthentication::class)($request->user());
        } else
            app(DisableTwoFactorAuthentication::class)($request->user());
        return redirect()->route('otp-generator');//->with('status', __('--'));
    }
}
