@extends('layout')
@section('content')
    <div class="container">
        <div class="card my-5">
            <div class="card-header">{{ __('OTP Generator') }}</div>
            <div class="card-body">
                <div class="row">
                    {{--<div dir="ltr">{{ $qrcodeUrl ?? '' }}</div>--}}
                    <div class="col text-center">
                        @if($qrcode)
                            {!! $qrcode !!}
                        @endif
                    </div>
                    <div class="col">
                        @if($recoveryCodes)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Recovery Codes') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recoveryCodes as $rCode)
                                    <tr>
                                        <th scope="row">{{$rCode}}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <form method="post" action="{{route('otp-generator.store')}}">
                    @csrf
                    <button
                        class="w-100 btn btn-lg {{ is_null(auth()->user()->two_factor_secret) ? 'btn-success' : 'btn-danger' }}"
                        type="submit">{{ is_null(auth()->user()->two_factor_secret) ? __('Enable') : __('Disable') }}</button>
                </form>

            </div>
        </div>
    </div>
@endsection
