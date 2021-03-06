@php
    if (session('class') and !isset($class)) {
        $class = \App\Models\Classes::find(session('class'));
    }
@endphp


{{-- Сайдбар на большем экране --}}
<div style="min-height: 700px" class="absolute z-40 lg:relative w-64 shadow bg-white hidden lg:block">

    <div class="h-16 w-full flex items-center px-8 text-3xl font-bold">
        <span>
            Расписание
        </span>
    </div>

    <ul class="">
        <a href="{{ route('index') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('index')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Главная
                </div>
            </li>
        </a>
        <a href="{{ route('lesson.index') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('lesson.*')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Предметы
                </div>
            </li>
        </a>
        <a href="{{ route('teacher.index') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('teacher.*')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Учителя
                </div>
            </li>
        </a>
        <a href="{{ route('classes.index') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('classes.*')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Классы
                </div>
            </li>
        </a>
        <a href="{{ route('load.index') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('load.*')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Нагрузка
                </div>
            </li>
        </a>
        <a href="{{ route('room.index') }}" class=""> {{-- TODO: Сделать кабинеты --}}
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('room.index')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Кабинеты
                </div>
            </li>
        </a>
        <a href="{{ route('editTimetable') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('editTimetable')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Расписание
                </div>
            </li>
        </a>
        <a href="{{ route('adminUsers') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('adminUsers')) border-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Пользователи
               </div>
            </li>
        </a>
        <a href="{{ route('announcementsIndex') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('announcementsIndex')) brder-b-2 border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Объявления
                </div>
            </li>
        </a>
        <a href="{{ route('ringEdit') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('ringEdit')) border-b border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Расписание звонков
                </div>
            </li>
        </a>
        <a href="{{ route('feedback.index') }}" class="">
            <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('feedback.index')) border-b border-b-blue-800 @endif">
                <div class="flex items-center ml-2">
                    Отзывы
                </div>
            </li>
        </a>
    </ul>
</div>

{{-- Сайдбар на мобильном экране --}}
<div class="absolute w-full h-full z-40 hidden" id="mobile-nav">
    <div class="bg-gray-800 opacity-50 absolute h-full w-full"></div> {{-- Затемнение экрана --}}

    <div class="absolute z-40 sm:relative w-64 md:w-96 shadow pb-4 bg-gray-100 lg: transition duration-150 ease-in-out h-full">
        <div class="flex flex-col justify-between h-full w-full">
            {{-- Верхние кнопки --}}
            <div>

                <div class="flex items-center justify-between px-8">
                    <div class="h-16 w-full flex items-center text-2xl font-bold">
                        Расписание
                    </div>
                    <button aria-label="close sidebar" id="closeSideBar" class="flex items-center justify-center h-10 w-10 focus:outline-none focus:ring-2 focus:ring-gray-800 rounded" >
                        <i class="fa-solid fa-xmark text-gray-800 text-2xl"></i>
                    </button>
                </div>

                <ul class="py-6"> {{-- TODO: Сделать ссылки --}}
                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('index')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('index') }}" class="ml-2 xl:text-base md:text-2xl text-base">Главная</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('lesson.index')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('lesson.index') }}" class="ml-2 xl:text-base md:text-2xl text-base">Предметы</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('teacher.index')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('teacher.index') }}" class="ml-2 xl:text-base md:text-2xl text-base">Учителя</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('classes.index')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('classes.index') }}" class="ml-2 xl:text-base md:text-2xl text-base">Классы</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('load.index')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('load.index') }}" class="ml-2 xl:text-base md:text-2xl text-base">Нагрузка</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('room.index')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('room.index') }}" class="ml-2 xl:text-base md:text-2xl text-base">Кабинеты</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('editTimetable')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('editTimetable') }}" class="ml-2 xl:text-base md:text-2xl text-base">Расписание</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('adminUsers')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('adminUsers')}}" class="ml-2 xl:text-base md:text-2xl text-base">Пользователи</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('announcementsIndex')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('announcementsIndex') }}" class="ml-2 xl:text-base md:text-2xl text-base">Объявления</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('ringEdit')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('ringEdit') }}" class="ml-2 xl:text-base md:text-2xl text-base">Расписание звонков</a>
                        </div>
                    </li>

                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none @if(request()->routeIs('feedback.index')) text-indigo-700 @endif">
                        <div class="flex items-center">
                            <a href="{{ route('feedback.index')}}" class="ml-2 xl:text-base md:text-2xl text-base">Отзывы</a>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Нижняя панель --}}
            <div class="w-full">
                <div class="border-t border-gray-300">
                    <div class="w-full flex items-center justify-between px-6 pt-1">
                        <div class="flex items-center">
                            <p class="md:text-xl text-gray-800 text-base leading-4 ml-2">
                                {{ Auth::user()->first_name ?? Auth::user()->name }} {{ Auth::user()->second_name ?? '' }}
                            </p>
                        </div>
                        <ul class="flex">
                            <li aria-label="open notifications" class="cursor-pointer text-white pt-5 pb-3 pl-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-gray-500 hover:text-gray-700"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Вверхняя панель --}}
<div class="w-full absolute top-0 left-0 z-10">
    <nav class="h-16 flex items-center lg:items-stretch justify-end lg:justify-between bg-white shadow relative z-10">
        <div class="hidden lg:flex w-full pr-6 flex justify-end">

            <div class="w-1/2 hidden lg:flex">
                <div class="w-full flex items-center pl-8 justify-end">

                    <div class="flex items-center relative cursor-pointer">

                        <div class="text-sm text-gray-600">{{ Auth::user()->name }}</div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="ml-4 text-sm text-gray-600">Выйти</button>
                        </form>

{{--                        <x-dropdown align="right" width="48">--}}
{{--                            <x-slot name="trigger">--}}
{{--                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">--}}
{{--                                    <div>{{ Auth::user()->name }}</div>--}}

{{--                                    <div class="ml-1">--}}
{{--                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                </button>--}}
{{--                            </x-slot>--}}

{{--                            <x-slot name="content">--}}
{{--                                <!-- Authentication -->--}}
{{--                                <x-dropdown-link :href="route('userEdit')">--}}
{{--                                    Редактировать профиль--}}
{{--                                </x-dropdown-link>--}}
{{--                                <form method="POST" action="{{ route('logout') }}">--}}
{{--                                    @csrf--}}

{{--                                    <x-dropdown-link :href="route('logout')"--}}
{{--                                                     onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                                        Выйти--}}
{{--                                    </x-dropdown-link>--}}
{{--                                </form>--}}
{{--                            </x-slot>--}}
{{--                        </x-dropdown>--}}

                    </div>

                </div>
            </div>
        </div>

        <button aria-label="Main Menu" class="text-gray-600 mr-8 visible lg:hidden relative focus:outline-none focus:ring-2 focus:ring-gray-600" onclick="openAdminNav()" id="openSideBar">
            <i class="fa-solid fa-bars text-2xl text-gray-400 focus:text-gray-900"></i>
        </button>

    </nav>
</div>
