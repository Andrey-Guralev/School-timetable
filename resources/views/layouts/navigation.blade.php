@php
    if (session('class')) {
        $class = \App\Models\Classes::find(session('class'));
    }
@endphp


<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                        Расписание
                    </x-nav-link>
                    @auth
                        @if(Auth::user()->type >= 3)
                            <x-nav-link :href="route('editTimetable')" :active="request()->routeIs('editTimetable')">
                                Изменить расписание
                            </x-nav-link>
                            <x-nav-link :href="route('editClasses')" :active="request()->routeIs('editClasses')">
                                Изменить классы
                            </x-nav-link>
                        @endif
                            @if(Auth::user()->type >= 4)
                                <x-nav-link :href="route('adminUsers')" :active="request()->routeIs('adminUsers')">
                                    Пользователи
                                </x-nav-link>
                            @endif
                            @if(Auth::user()->type >= 2)
                                <x-nav-link :href="route('announcementsIndex')" :active="request()->routeIs('announcementsIndex')">
                                    Обьявления
                                </x-nav-link>
                            @endif
                            @if(Auth::user()->type >= 4)
                                <x-nav-link :href="route('ringEdit')" :active="request()->routeIs('ringEdit')">
                                    Расписание звонков
                                </x-nav-link>
                            @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ml-6">
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
            @elseif(session('class'))
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>
                                    {{ $class->number }}{{ $class->letter }}
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('classLogout')">
                                Выйти
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>            @else
                <div class="flex justify-between items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <a href="{{ route('classesLogin') }}" class="pr-4">Войти в класс</a>
                    <a href="{{ route('login') }}" class="pr-4">Войти в аккаунт</a>
                </div>
            @endauth
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')">
                    Расписание
                </x-responsive-nav-link>
                @auth
                    @if(Auth::user()->type >= 3)
                        <x-responsive-nav-link :href="route('editTimetable')" :active="request()->routeIs('editTimetable')">
                            Изменить расписание
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('editClasses')" :active="request()->routeIs('editClasses')">
                            Изменить классы
                        </x-responsive-nav-link>
                    @endif
                    @if(Auth::user()->type >= 4)
                        <x-responsive-nav-link :href="route('adminUsers')" :active="request()->routeIs('adminUsers')">
                            Пользователи
                        </x-responsive-nav-link>
                    @endif
                    @if(Auth::user()->type >= 2)
                        <x-responsive-nav-link :href="route('announcementsIndex')" :active="request()->routeIs('announcementsIndex')">
                            Обьявления
                        </x-responsive-nav-link>
                    @endif
                @endauth

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            Выйти
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>

        @elseif(session('class'))
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">
                        {{ $class->number }}{{ $class->letter }}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('classLogout')">
                        Выйти
                    </x-responsive-nav-link>
                </div>
            </div>

        @endif
    </div>
</nav>
