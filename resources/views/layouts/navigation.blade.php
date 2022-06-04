@php
    if (session('class') and !isset($class)) {
        $class = \App\Models\Classes::find(session('class'));
    }
@endphp


<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                            Расписание
                        </x-nav-link>

                        @if(Auth::user()->type >= 2)
                            <x-nav-link :href="route('announcementsIndex')" :active="request()->routeIs('announcementsIndex')">
                                Объявления
                            </x-nav-link>
                        @endif

                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="text-sm text-gray-600">{{ Auth::user()->name }}</div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="ml-4 text-sm text-gray-600">Выйти</button>
                    </form>

                </div>
            @elseif(session('class'))
                <div class="sm:flex sm:items-center sm:justify-between  flex items-center ml-6 items-center">
                    <div>
                        <div class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ $class->number }}{{ $class->letter }}
                        </div>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('classLogout') }}" class="ml-4 text-sm text-gray-500">
                            Вернуться на главную
                        </a>
                    </div>
                </div>
            @else
                <div class="flex justify-between items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <a href="{{ route('classesLogin') }}" class="pr-4">Войти в класс</a>
                    <a href="{{ route('login') }}" class="pr-4">Войти в аккаунт</a>
                </div>
            @endauth

            <!-- Hamburger -->
            @if(!session('class'))
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{--  Меню для телефонов  --}}
    @if(!session('class'))
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
                        @if(Auth::user()->type >= 2)
                            <x-responsive-nav-link :href="route('announcementsIndex')" :active="request()->routeIs('announcementsIndex')">
                                Объявления
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
            @endif
        </div>
    @endif
</nav>
