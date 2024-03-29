<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#7952b3">

    <title>{{ config('app.name') }}</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }
    </style>
</head>
<body dir="{!! in_array(app()->getLocale(), ['fa']) ? 'rtl' : 'ltr' !!}">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="bootstrap" viewBox="0 0 118 94">
        <title>Bootstrap</title>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
    </symbol>
</svg>
<header class="p-3 bg-info text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"/>
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto m-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ url('/') }}"
                       class="nav-link px-2 {{ Request::is('/') ? 'text-secondary' : 'text-white' }}">{{ __('Home') }}</a></li>
                @auth()
                    <li><a href="{{ route('admins.dashboard') }}"
                           class="nav-link px-2 {!! Request::is('admins/dashboard') ? 'text-secondary' : 'text-white' !!}">{{ __('Dashboard') }}</a>
                    </li>
                    <li><a href="{{ route('admins.profile') }}"
                           class="nav-link px-2 {!! Request::is('admins/profile') ? 'text-secondary' : 'text-white' !!}">{{ __('Profile') }}</a>
                    </li>
                @endauth
            </ul>

            <div class="text-end">
                @auth()
                    <a href="{{ route('auth.logout') }}" class="btn btn-danger">{{ __('Logout') }}</a>
                @endauth
                @guest()
                    <a href="{{ route('auth.auth') }}" class="btn btn-info me-2">{{ __('Admins Register/Login') }}</a>
                    <a href="{{ route('auth.auth') }}" class="btn btn-warning">{{ __('Users Register/Login') }}</a>
                @endguest
                <span class="btn border">
                <a href="/locale/fa"><img src="https://lipis.github.io/flag-icon-css/flags/4x3/ir.svg" alt="fa"
                                          width="30"/></a>
                <a href="/locale/en"><img src="https://lipis.github.io/flag-icon-css/flags/4x3/us.svg" alt="en"
                                          width="30"/></a>
                </span>
            </div>

        </div>
    </div>
</header>
@if(session()->has('status'))
    <div class="container">
        <div class="alert alert-primary mt-3" role="alert">
            {{ session('status') }}
        </div>
    </div>
@endif
@yield('content')
</body>
</html>
