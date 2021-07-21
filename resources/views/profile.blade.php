@extends('layout')
@section('content')

    @if ($errors->any())
        <div class="container">
            <div class="alert alert-danger mt-3" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="card my-5">
            <div class="card-header">{{ __('Profile') }}</div>
            <div class="card-body row justify-content-md-center">
                <form method="post" action="{{route('profile.store')}}" class="col-6">
                    @csrf

                    <div class="form-floating mb-3">
                        <input name="name" class="form-control" id="floatingInputName" placeholder="{{ __('Name') }}"
                               required value="{{ $user->name }}">
                        <label for="floatingInputName">{{ __('Name') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="family" class="form-control" id="floatingInputFamily"
                               placeholder="{{ __('Family') }}" required value="{{ $user->family }}">
                        <label for="floatingInputFamily">{{ __('Family') }}</label>
                    </div>

                    <div dir="ltr" class="form-floating mb-3">
                        <input name="email" pattern="^[1-9a-z.]+@\w+\.\w{3,}$" class="form-control" id="floatingInputEmail" placeholder="{{ __('Email') }}" value="{{ $user->email }}" required>
                        <label for="floatingInputEmail">{{ __('Email') }}</label>
                        <div class="form-text">e.g. sample@gmail.com</div>
                    </div>

                    <div dir="ltr" class="form-floating mb-3">
                        <input name="phone" pattern="^(\+\d{1,3})+\d{10}$" class="form-control" id="floatingInputPhone" placeholder="{{ __('Phone') }}" value="{{ $user->phone }}" required>
                        <label for="floatingInputPhone">{{ __('Phone') }}</label>
                        <div class="form-text">e.g. +989123456789</div>
                    </div>

                    @if(in_array(config('novel-auth.login_mode'), ['optional_password_code', 'optional_code_password']))
                        <div class="form-check mb-3">
                            <input name="login_force_both" class="form-check-input" type="checkbox" value="true"
                                   id="flexCheckChecked" {!! $user->login_force_both ? 'checked' : '' !!}>
                            <label class="form-check-label" for="flexCheckChecked">
                                {{ __('Force OTP and Password for login') }}
                            </label>
                        </div>
                    @endif

                    <button class="w-100 btn btn-lg btn-info" type="submit">{{ __('Save') }}</button>
                </form>

            </div>
        </div>
    </div>
@endsection
