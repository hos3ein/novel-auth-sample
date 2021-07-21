@extends('layout')
@section('content')
    <div class="container">

        <div class="card my-5">
            <div class="card-header">{{ __('Configs') }}</div>
            <div class="card-body">
                <form method="post" action="{{route('configs.store')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="otp_services" class="form-label">OTP services</label>
                        <select name="otp_services[]" multiple class="form-select" id="otp_services" size="8">
                            <option value="empty" {!!  empty(config('novel-auth.otp_services')) ? 'selected' : '' !!}>Nothing</option>
                            @foreach(['email','call','sms','ussd','telegram','whatsapp', 'otp_generator'] as $option)
                                <option
                                    value="{{$option}}" {!! in_array($option, config('novel-auth.otp_services')) ? 'selected' : '' !!}>{{$option}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="register_methods" class="form-label">Register methods</label>
                        <select name="register_methods[]" multiple class="form-select" id="register_methods" size="3">
                            <option value="d" {!!  empty(config('novel-auth.register_methods')) ? 'selected' : '' !!}>Disable Register</option>
                            <option value="e" {!!  in_array('e', config('novel-auth.register_methods')) ? 'selected' : '' !!}>Email</option>
                            <option value="m" {!!  in_array('m', config('novel-auth.register_methods')) ? 'selected' : '' !!}>Phone</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="register_phone_opt_services" class="form-label">Register with phone OTP services</label>
                        <select name="register_phone_opt_services[]" multiple class="form-select" id="register_phone_opt_services" size="4">
                            <option value="empty" {!!  empty(config('novel-auth.register_phone_opt_services')) ? 'selected' : '' !!}>Nothing</option>
                            @foreach(['call','sms','ussd'] as $option)
                                <option
                                    value="{{$option}}" {!! in_array($option, config('novel-auth.register_phone_opt_services')) ? 'selected' : '' !!}>{{$option}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="register_mode" class="form-label">Register mode</label>
                        <select name="register_mode" class="form-select" id="register_mode">
                            @foreach(['code_password', 'code', 'password'] as $option)
                                <option
                                    value="{{$option}}" {!! config('novel-auth.register_mode') == $option ? 'selected' : '' !!}>{{$option}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="login_mode" class="form-label">Login mode</label>
                        <select name="login_mode" class="form-select" id="login_mode">
                            <option value="null">Disable Login</option>
                            @foreach(['password','code','password_code','code_password','optional_password_code','optional_code_password'] as $option)
                                <option
                                    value="{{$option}}" {!! config('novel-auth.login_mode') == $option ? 'selected' : '' !!}>{{$option}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
