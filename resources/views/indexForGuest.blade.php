<x-app-layout>
    @if(Auth::guest() && !session('class'))
        <x-container class="" style="color: #003A80">
            <h1 class="text-4xl font-bold text-center">Расписание МАОУ Лицей №6 "Перспектива"</h1>
{{--            <h2 class="sm:mt-4 lg:mt-1.5 text-2xl">Чтобы посмотреть расписание надо <a href="{{ route('classesLogin') }}" class="text-blue-900 underline">выбрать класс</a></h2>--}}
            <div class="logo flex justify-center">
                <img src="{{ asset('img/logo.svg') }}" alt="" class="">
            </div>
            <h2 class="sm:mt-4 lg:mt-1.5 text-2xl text-center"><a href="{{ route('classesLogin') }}" class=" underline">Выбрать класс</a></h2>
        </x-container>
    @endif
</x-app-layout>
