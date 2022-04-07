<!--
    Сайт сделал: Андрей Гуралев
    Vk: https://vk.com/n11ckname
    Github: https://github.com/Andrey-Guralev
-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="author" content="Andrey Guralev">
        <meta name="description" content="Расписание школы Лицей №6 г. Красноярск">

        <title>Расписание Лицея №6</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="shortcut icon" href="{{ asset('favicon-white.svg') }}" type="image/x-icon">

{{--        <link rel="manifest" href="{{ asset('manifest.json') }}">--}}

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    </head>
    <body class="font-sans antialiased">
        <div class=" shadow bg-gray-100" style="height: fit-content" id="app">
            <div class="min-h-screen flex flex-no-wrap">

                @include('admin.layouts.adminNavigation')

                <div class="w-full pt-20 ">
                        {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
