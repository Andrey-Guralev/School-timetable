<x-app-layout>
    @if(Auth::guest() && !session('class'))
        <x-container class="" style="color: #003A80">
            <h1 class="text-4xl font-bold text-center">Расписание МАОУ Лицей №6 "Перспектива"</h1>
{{--            <h2 class="sm:mt-4 lg:mt-1.5 text-2xl">Чтобы посмотреть расписание надо <a href="{{ route('classesLogin') }}" class="text-blue-900 underline">выбрать класс</a></h2>--}}
            <div class="logo flex justify-center">
                <img src="{{ asset('img/logo.svg') }}" alt="" class="">
            </div>
            <h2 class="sm:mt-4 lg:mt-1.5 text-2xl text-center"><a href="{{ route('classesLogin') }}" class=" underline">Выбрать класс</a></h2>
            <h2 class="sm:mt-4 lg:mt-1.5 text-2xl text-center"><a href="{{ route('feedback.all') }}" class=" underline">Отзывы</a></h2>
            <h3 class="mt-4 text-center">За последние двое суток сайт посетило: {{ $count }} {{ trans_choice('[0,1] человек|[2,4] человека|[5,*] человек', $count) }}</h3>
        </x-container>



{{--        <x-container class="flex justify-between items-center">--}}
{{--            <x-feedback :classes="$classes" />--}}
{{--            <h3 class="text-3xl font-bold" style="color: #003A80">Последние озывы</h3>--}}
{{--            <a href="{{ route('feedback.createPage') }}" class="bold mb-2 mx-1 bg-blue-600 block h-8 px-2 flex justify-center items-center rounded text-white hover:bg-blue-700 transition">--}}
{{--                Оставить отзыв--}}
{{--            </a>--}}
{{--        </x-container>--}}

{{--        @foreach($feedback as $fb)--}}
{{--            <x-container class="flex flex-col">--}}
{{--                <div>--}}
{{--                    <div class="text-2xl font-medium">--}}
{{--                        {{ $fb->first_name }} {{ $fb->second_name }}--}}
{{--                    </div>--}}
{{--                    <div class="text-sm">--}}
{{--                        {{ $fb->class_id != 0 ? $fb->Class->getFullName() : "Учитель" }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="ml-4 mt-4 text-xl">--}}
{{--                    {{ $fb->text }}--}}
{{--                </div>--}}
{{--                <div class="flex justify-between mt-4">--}}
{{--                </div>--}}
{{--                <div class="text-gray-600">--}}
{{--                    {{ $fb->created_at->diffForHumans() }}--}}
{{--                </div>--}}
{{--            </x-container>--}}
{{--        @endforeach--}}

{{--        <x-container>--}}
{{--            <a href="{{ route('feedback.all') }}" class="bold mb-2 mx-1 bg-blue-600 block h-8 px-2 flex justify-center items-center rounded text-white hover:bg-blue-700 transition">--}}
{{--                Посмотреть все отзывы--}}
{{--            </a>--}}
{{--        </x-container>--}}
    @endif
</x-app-layout>
