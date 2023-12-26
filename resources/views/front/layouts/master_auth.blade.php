<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('front/image/icon.png') }}">
    <title>@yield('page_title')</title>
    @include( 'front.layouts.header_styles')
</head>
<body>
@yield('main_content')
@include( 'front.layouts.footer_scripts')
@include('front.layouts.alert.alert')
@stack('front_custom_scripts')
</body>

</html>
