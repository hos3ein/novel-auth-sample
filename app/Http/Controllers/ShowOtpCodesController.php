<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Hos3ein\NovelAuth\Features\Constants;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;

class ShowOtpCodesController extends BaseController
{
    // Just for test NovelAuth package.
    public function index()
    {
        return view('show_otp_codes');
    }

    public function store(Request $request)
    {
        if ($request->guard == 'users') {
            $user = User::whereEmail($request->email_phone)->orWhere('phone', $request->email_phone)->first();
        } elseif ($request->guard == 'admins') {
            $user = Admin::whereEmail($request->email_phone)->orWhere('phone', $request->email_phone)->first();
        } else $user = null;
        if ($user) {
            $otpCodes = $user->otpCodes()->get();
            $res = [];
            foreach ($otpCodes as $code) {
                if ($code->code)
                    $res[$code->type] = is_int($code->code)
                        ? $code->code
                        : config(Constants::$configEncryptOtpCode)
                            ? Crypt::decryptString($code->code)
                            : $code->code;
                else
                    $res[$code->type] = $code->code;
            }
            if (!empty($res))
                return back()->withInput(array_merge($request->all(), ['codes' => $res]));
        }
        return back()->withInput($request->all())->with('status', __('Not found!'));
    }
}
