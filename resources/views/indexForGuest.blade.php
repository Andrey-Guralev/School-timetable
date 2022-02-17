<x-app-layout>
    @if(Auth::guest() && !session('class'))
        <x-container>
            <h1 class="text-4xl font-bold">Добро пожаловать, это расписание Лицея №6</h1>
            <h2 class="sm:mt-4 lg:mt-1.5 text-2xl">Чтобы посмотреть расписание надо <a href="{{ route('classesLogin') }}" class="text-blue-700 underline">войти в класс</a></h2>
        </x-container>
    @endif
</x-app-layout>
