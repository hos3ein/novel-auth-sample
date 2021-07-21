@extends('layout')
@section('content')
    <div class="container">
        <div class="container">
            <div class="row my-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header">{{ __('Show OTP codes') }}</div>
                        <div class="card-body">
                            <form method="post" action="{{route('show-otp-codes.store')}}">
                                @csrf

                                <div dir="ltr" class="form-floating mb-3">
                                    <input name="email_phone" dir="ltr" pattern="^((\+\d{1,3})+\d{10})|([1-9a-z.]+@\w+\.\w{3,})$" class="form-control" id="floatingInput"
                                           placeholder="{{ __('Email/Phone') }}" required
                                           value="{{ old('email_phone') }}">
                                    <label for="floatingInput">{{ __('Email/Phone') }}</label>
                                    <div class="form-text">e.g. +989123456789 | sample@gmail.com</div>
                                </div>

                                <div class="mb-3">
                                    <label for="guard" class="form-label"></label>
                                    <select name="guard" class="form-select" id="guard" required>
                                        <option
                                            value="users" {!! old('guard') == 'users' ? 'selected' : '' !!}>{{ __('Users') }}</option>
                                        <option
                                            value="admins" {!! old('guard') == 'admins' ? 'selected' : '' !!}>{{ __('Admins') }}</option>
                                    </select>
                                </div>

                                <button class="w-100 btn btn-lg btn-info" type="submit">{{ __('Show') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">{{ __('Codes') }}</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Type') }}</th>
                                    <th scope="col">{{ __('Code') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(old('codes', []) as $key => $code)
                                    <tr>
                                        <th scope="row">{{$key}}</th>
                                        <td>{{$code}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
