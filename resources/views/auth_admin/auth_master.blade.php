<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('auth_admin_title')</title>
    <link rel="stylesheet" href="{{ asset('dash/css/style.bundle.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/admin_custom.css') }}">
</head>
<body class="admin-section w3-flat-clouds">
@yield('main_content')
<script type="text/javascript" src="{{ asset('dash/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.alert-div').delay(3000).fadeOut();
    })
</script>
@stack('admin_custom_scripts')
</body>
</html>
