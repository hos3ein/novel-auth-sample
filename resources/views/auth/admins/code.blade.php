@extends('auth.admins.layout')
@section('content')

    <form method="post" action="{{route('auth.auth')}}">
        @csrf
        <input type="hidden" name="token_rc" value="{{$token_rc}}">

        <div class="mb-3">{{ $message ?? '' }}</div>

        <div dir="ltr" class="form-floating mb-3">
            <input name="code" class="form-control" id="floatingInput" placeholder="{{ __('Code') }}" required>
            <label for="floatingInput">{{ __('Code') }}</label>
        </div>

        @if(!in_array($otpType, [\Hos3ein\NovelAuth\Features\Constants::$OTP_GENERATOR, \Hos3ein\NovelAuth\Features\Constants::$OTP_USSD]))
            <button id="btn_resend" onclick="resendCode()" class="btn btn-link" disabled>{{ __('Resend otp') }} ({{ $ttl }})</button>
            <script>
                window.onload = function () {
                    let sec = parseInt('{{ $ttl }}');
                    if (sec === 0) {
                        document.getElementById('btn_resend').innerText = 'Resend otp';
                        document.getElementById('btn_resend').removeAttribute('disabled');
                    } else if (sec > 0) {
                        let countDown = setInterval(() => {
                            sec--;
                            document.getElementById('btn_resend').innerText = '{{ __('Resend otp') }} (' + sec + ')';
                            if (sec === 0) {
                                clearInterval(countDown);
                                document.getElementById('btn_resend').innerText = '{{ __('Resend otp') }}';
                                document.getElementById('btn_resend').removeAttribute('disabled');
                            }
                        }, 1000);
                    }
                };

                function resendCode() {
                    let form = document.getElementsByTagName('form')[0];
                    document.getElementsByName('code')[0].value = '';

                    let input = document.createElement('input');
                    input.setAttribute('name', 'force_otp_type');
                    input.setAttribute('value', '{{ $otpType }}');
                    input.setAttribute('type', 'hidden');
                    form.appendChild(input);
                    form.submit();
                }
            </script>
        @endif
        <button class="w-100 btn btn-lg btn-info" type="submit">{{ __('Submit') }}</button>

        <div>
            @if(count($otpOptions)>1)
                <button onclick="change2Otp()" class="btn btn-link">{{ __('Select another OTP') }}</button>
                <script>
                    function change2Otp() {
                        let form = document.getElementsByTagName('form')[0];
                        document.getElementsByName('code')[0].value = '';

                        let input = document.createElement('input');
                        input.setAttribute('name', 'force_otp_type');
                        input.setAttribute('value', 'otp_options');
                        input.setAttribute('type', 'hidden');
                        form.appendChild(input);

                        form.submit();
                    }
                </script>
            @endif

            @if($canPassword)
                <button onclick="change2pass()" class="btn btn-link">{{ __('Login with password') }}</button>
                <script>
                    function change2pass() {
                        let form = document.getElementsByTagName('form')[0];
                        document.getElementsByName('code')[0].value = '';

                        let input = document.createElement('input');
                        input.setAttribute('name', 'force_otp_type');
                        input.setAttribute('value', 'password');
                        input.setAttribute('type', 'hidden');
                        form.appendChild(input);

                        form.submit();
                    }
                </script>
            @endif
        </div>
    </form>
@endsection
