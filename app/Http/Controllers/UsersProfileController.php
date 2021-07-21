<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;

class UsersProfileController extends BaseController
{
    public function index(Request $request)
    {
        return view('profile', ['user' => $request->user()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'family' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)],
            'phone' => ['required', Rule::unique('users')->ignore($request->user()->id)],
            'login_force_both' => 'filled',
        ]);
        $request->user()->setVerifyAt('email');
        $request->user()->setVerifyAt('phone');
        $request->user()->forceFill(array_merge(['login_force_both' => $request->filled('login_force_both')], $request->only(['name', 'family', 'email', 'phone'])))->save();
        return redirect()->route('profile')->with('status', __('Profile updated'));
    }
}
