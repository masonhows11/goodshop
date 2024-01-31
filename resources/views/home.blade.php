<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="{{ asset('front/image/icon.png') }}">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>{{ env('APP_NAME') }}</title>
            @include('front.layouts.header_styles')
        </head>
    <body>

    <!-- start top ads -->
    <livewire:front.layout.front-top-advertising/>
    <!-- end top ads -->


    <!-- start header -->
    <livewire:front.layout.front-header/>
    <!-- end header -->

    <!-- start main menu -->
    <livewire:front.layout.front-navbar/>
    <!-- end main menu -->

    <!-- start main slider -->
    <livewire:front.layout.front-main-slider/>
    <!-- end main slider -->

    <!-- start main -->
    <main>
        <div class="container">

            <!-- start best suggestion slider -->
            <!-- start ads -->
            <livewire:front.layout.front-amazing-offer/>
            <!-- end best suggestion slider -->
            <!-- end ads -->

            <!-- start product slider -->
            <livewire:front.layout.front-product-category-slider/>
            <!-- end product slider -->

            <!-- start ads -->
            <livewire:front.layout.front-banner/>
            <!-- end ads -->

            <!-- start category box -->
            <livewire:front.layout.front-category-slider/>
            <!-- end category box -->

            <!-- start our suggestion box -->
            <livewire:front.layout.front-suggestions/>
            <!-- end our suggestion box -->

            <!-- start brands slider -->
            <livewire:front.layout.front-brands-slider/>
            <!-- end brands slider -->

            <!-- start blog box -->
            <livewire:front.layout.front-posts/>
            <!-- end blog box -->

        </div>
    </main>
    <!-- end main -->

    <!-- start footer -->
    <livewire:front.layout.front-footer/>
    <!-- end footer -->


    @include('front.layouts.footer_scripts')
    @include('front.layouts.alert.alert')
    @stack('custom_scripts')
    </body>
</html>
