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
    </head>
    <body class="font-sans antialiased">
        <div  class="min-h-screen shadow bg-gray-100 flex flex-col justify-between" style="">
            <div>
                @include('layouts.navigation')

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            <footer class="" style="">
                <div class="flex justify-center max-w-7xl mx-auto py-6 px-4">
                    <div class="mt-8 md:mt-0 md:order-1">
                        <p class="text-center text-base text-gray-400">
                            © 2022 <a href="https://liceum6.ru/" target="_blank" class="underline">Лицей 6 "Перспектива"</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
