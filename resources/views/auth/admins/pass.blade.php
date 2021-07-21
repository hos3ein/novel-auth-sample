@extends('auth.admins.layout')
@section('content')

    <form method="post" action="{{route('auth.auth')}}">
        @csrf
        <input type="hidden" name="token_rc" value="{{$token_rc}}">

        <div class="mb-3">{{ $message ?? '' }}</div>

        <div dir="ltr" class="form-floating">
            <input type="password" name="pass" class="form-control" id="floatingInput" placeholder="{{ __('Password') }}" required>
            <label for="floatingInput">{{ __('Password') }}</label>
        </div>

        <button class="w-100 btn btn-lg btn-info mt-3" type="submit">{{ __('Submit') }}</button>

        @if($canOtp)
            <button onclick="change2Otp()" type="button" class="btn btn-link">{{ __('Login with OTP') }}</button>
            <script>
                function change2Otp() {
                    let form = document.getElementsByTagName('form')[0];
                    document.getElementsByName('pass')[0].value = '';

                    let input = document.createElement('input');
                    input.setAttribute('name', 'force_otp_type');
                    input.setAttribute('value', 'otp_options');
                    input.setAttribute('type', 'hidden');
                    form.appendChild(input);

                    form.submit();
                }
            </script>
        @endif
    </form>
@endsection
