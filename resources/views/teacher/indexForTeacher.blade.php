<x-app-layout>


    @auth

        @if(Auth::user()->Teacher)
            <x-responsive-container class="flex flex-wrap sm:w-full lg:w-9/12">

                    <div class="block w-full">
                        <h2 class="text-3xl">Здраствуйте, {{ (Auth::user()->first_name ?? Auth::user()->name) . ' ' . (Auth::user()->middle_name ?? '')  }}</h2>
                        <h2 class="text-2xl">Расписание для вас</h2>
                    </div>

                    <teacher-timetable-index teacher-id="{{ Auth::user()->Teacher->id }}"></teacher-timetable-index>
            </x-responsive-container>
        @endif

{{--        <x-responsive-container class="flex flex-wrap sm:w-full lg:w-9/12">--}}
{{--            <div class="block w-full">--}}
{{--                <h2 class="text-3xl">Классы</h2>--}}
{{--            </div>--}}
{{--            <div class="ml-4 flex flex-wrap">--}}
{{--                @foreach($classes as $class)--}}
{{--                    <a href="{{ route('tim') }}" class="mb-2 mx-1 bg-blue-600 block h-8 px-2 flex justify-center items-center rounded text-white hover:bg-blue-700 transition">--}}
{{--                        {{ $class->number }}{{ $class->letter }}--}}
{{--                    </a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </x-responsive-container>--}}
    @endauth

        <x-container class="flex justify-between">
            <h1 class="text-3xl">Последние объявления</h1>
            <a href="{{ route('announcementsCreate') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">Добавить обьявление</a>
        </x-container>

        @foreach($announcements as $announcement)
            <x-container>
                <div class="header">
                    <h2 class="title text-xl bold">
                        {{ $announcement->title }}
                    </h2>
                </div>
                <div class="main ml-4">
                    <p class="text">
                        {!! substr(strip_tags($announcement->text), 0, 30) . "..." !!}
                    </p>
                </div>
                <div class="type text-gray-700 mt-4">
                    @if($announcement->type == 1)
                        Для всей школы
                    @else
                        Для вашего класса
                    @endif
                </div>
                <div class="buttons mt-2">
                    <a href="{{ route('announcementShow', ['id' => $announcement->id]) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
                        Просмотреть
                    </a>
                    @auth()
                        @if($announcement->author_id == Auth::user()->id || Auth::user()->type > 4)
                            <a href="{{ route('announcementsEdit', ['id' => $announcement->id]) }}" class="mr-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
                                Редактировать
                            </a>
                            <form action="{{ route('announcementsDelete', ['id' => $announcement->id]) }}" method="POST">
                                @method("DELETE")
                                @csrf
                                <button type="submit" onclick="confirm('Точно удалить объявление');" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Удалить
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </x-container>
        @endforeach
</x-app-layout>
