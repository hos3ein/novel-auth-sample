<?php

namespace App\Actions\NovelAuth;

use App\Models\Admin;
use App\Models\User;
use Hos3ein\NovelAuth\Contracts\AccountManager as AccountManagerContacts;
use Hos3ein\NovelAuth\Features\Constants;

class AccountManager implements AccountManagerContacts
{
    public function findOrCreateIncompleteRegistrationUser($emailPhone, $inputType)
    {
        if (request()->isAdmins()) {
            $user = Admin::where($inputType == Constants::$EMAIL_MODE ? 'email' : 'phone', $emailPhone)->first();
            if ($user)
                return $user;
            $user = new Admin();
            if ($inputType == Constants::$EMAIL_MODE)
                $user->email = $emailPhone;
            else
                $user->phone = $emailPhone;
            $user->status = Constants::$STATUS_INCOMPLETE_REGISTRATION;
            $user->save();
            return $user;
        } else {
            $user = User::where($inputType == Constants::$EMAIL_MODE ? 'email' : 'phone', $emailPhone)->first();
            if ($user)
                return $user;
            $user = new User();
            if ($inputType == Constants::$EMAIL_MODE)
                $user->email = $emailPhone;
            else
                $user->phone = $emailPhone;
            $user->status = Constants::$STATUS_INCOMPLETE_REGISTRATION;
            $user->save();
            return $user;
        }
    }
}
