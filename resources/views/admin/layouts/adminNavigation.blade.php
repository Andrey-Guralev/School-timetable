@php
    if (session('class') and !isset($class)) {
        $class = \App\Models\Classes::find(session('class'));
    }
@endphp


{{-- Сайдбар на большем экране --}}
<div style="min-height: 700px" class="absolute z-40 lg:relative w-64 shadow bg-white hidden lg:block">

    <div class="h-16 w-full flex items-center px-8 text-3xl font-bold">
        Расписание
    </div>

    <ul class="">
        <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none">
            <div class="flex items-center">
                <a href="javascript:void(0)" class="ml-2">Dashboard</a>
            </div>
        </li>
        <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none">
            <div class="flex items-center">
                <a href="javascript:void(0)" class="ml-2">Products</a>
            </div>
        </li>
        <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none">
            <div class="flex items-center">
                <a href="javascript:void(0)" class="ml-2">Performance</a>
            </div>
        </li>
        <li class="pl-6 text-gray-600 pt-3 pb-3 hover:text-blue-800 hover:bg-blue-100 focus:text-indigo-700 focus:outline-none">
            <div class="flex items-center">
                <a href="javascript:void(0)" class="ml-2">Deliverables</a>
            </div>
        </li>
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

                <ul class="py-6">
                    <li class="pl-6 cursor-pointer text-white text-sm leading-3 tracking-normal pb-4 pt-5 text-indigo-700 focus:text-indigo-700 focus:outline-none">
                        <div class="flex items-center">
                            <a href="javascript:void(0)" class="ml-2 xl:text-base md:text-2xl text-base">Dashboard</a>
                        </div>
                    </li>
                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mt-4 mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none">
                        <div class="flex items-center">
                            <a href="javascript:void(0)" class="ml-2 xl:text-base md:text-2xl text-base">Products</a>
                        </div>
                    </li>
                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal mb-4 py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none">
                        <div class="flex items-center">
                            <a href="javascript:void(0)" class="ml-2 xl:text-base md:text-2xl text-base">Performance</a>
                        </div>
                    </li>
                    <li class="pl-6 cursor-pointer text-gray-600 text-sm leading-3 tracking-normal py-2 hover:text-indigo-700 focus:text-indigo-700 focus:outline-none">
                        <div class="flex items-center">

                            <a href="javascript:void(0)" class="ml-2 xl:text-base md:text-2xl text-base">Deliverables</a>
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
                                {{ Auth::user()->first_name ?? Auth::user()->name }}{{ Auth::user()->second_name ?? '' }}
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

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <x-dropdown-link :href="route('userEdit')">
                                    Редактировать профиль
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        Выйти
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>

                    </div>

                </div>
            </div>
        </div>

        <button aria-label="Main Menu" class="text-gray-600 mr-8 visible lg:hidden relative focus:outline-none focus:ring-2 focus:ring-gray-600" onclick="openAdminNav()" id="openSideBar">
            <i class="fa-solid fa-bars text-2xl text-gray-800"></i>
        </button>

    </nav>
</div>
