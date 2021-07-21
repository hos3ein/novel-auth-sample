@extends('auth.admins.layout')
@section('content')
    <form method="post" action="{{route('auth.auth')}}">
        @csrf
        <input type="hidden" name="token_rc" value="{{$token_rc}}">

        <div class="mb-3">{{ $message ?? '' }}</div>

        <div dir="ltr" class="form-floating mb-3">
            <input type="password" name="pass" class="form-control" id="floatingInput" placeholder="{{ __('Password') }}" required>
            <label for="floatingInput">{{ __('Password') }}</label>
        </div>
        <div dir="ltr" class="form-floating">
            <input type="password" name="pass_conf" class="form-control" id="floatingInput" placeholder="{{ __('Password Confirmation') }}" required>
            <label for="floatingInput">{{ __('Password Confirmation') }}</label>
        </div>

        <button class="w-100 btn btn-lg btn-info mt-3" type="submit">{{ __('Submit') }}</button>
    </form>
@endsection
