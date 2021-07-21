@extends('auth.admins.layout')
@section('content')
    <form method="post" action="{{route('auth.auth')}}">
        @csrf

        <div class="mb-3">{{ $message ?? '' }}</div>

        <div dir="ltr" class="form-floating">
            <input name="email_phone" pattern="^((\+\d{1,3})+\d{10})|([1-9a-z.]+@\w+\.\w{3,})$" class="form-control" id="floatingInput" placeholder="{{ __('Email/Phone') }}" required>
            <label for="floatingInput">{{ __('Email/Phone') }}</label>
            <div class="form-text">e.g. +989123456789 | sample@gmail.com</div>
        </div>

        <button class="w-100 btn btn-lg btn-info mt-3" type="submit">{{ __('Login') }}</button>
    </form>
@endsection
