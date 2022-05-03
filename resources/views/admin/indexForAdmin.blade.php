<x-app-layout>

    <x-responsive-container class="lg:flex lg:flex-wrap lg:w-11/12 sm:block sm:w-full">
        <div class="block w-full">
            <h2 class="text-2xl">Классы</h2>
        </div>
        <div class="ml-4 flex flex-wrap">
            @foreach($classes as $class)
                <a href="{{ route('timetableForClass', ['id' => $class->id]) }}" class="mb-2 mx-1 bg-blue-600 block h-8 px-2 flex justify-center items-center rounded text-white hover:bg-blue-700 transition">
                    {{ $class->number }}{{ $class->letter }}
                </a>
            @endforeach
        </div>
        <div class="flex flex-col mt-8">
            <h3 class="mt-4">За последние двое суток сайт посетило: {{ $count }} {{ trans_choice('[0,1] человек|[2,4] человека|[5,*] человек', $count) }}</h3>
            <h3 class="mt-4">На телеграм бота подписано: {{ $telegramSubsCount }} {{ trans_choice('[0,1] человек|[2,4] человека|[5,*] человек', $telegramSubsCount) }}</h3>
        </div>
    </x-responsive-container>

    <x-responsive-container class="flex justify-between  lg:w-11/12 sm:w-full">
        <h1 class="text-3xl">Объявления</h1>
        <a href="{{ route('announcementsCreate') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
            Добавить обьявление
        </a>
    </x-responsive-container>

    @foreach($announcements as $announcement)
        <x-responsive-container class="lg:w-9/12 sm:w-full">
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
                    Для всей школы  44
                @else
                    Для {{ $announcement->Classes->getFullName ?? '' }}
                @endif
            </div>
            <div class="buttons mt-2 flex">
                <a href="{{ route('announcementShow', ['id' => $announcement->id]) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
                    Просмотреть
                </a>
                @auth()
                    @if($announcement->author_id == Auth::user()->id || Auth::user()->type >= 4)
                        <a href="{{ route('announcementsEdit', ['id' => $announcement->id]) }}" class="mx-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
                            Редактировать
                        </a>
                        <form action="{{ route('announcementsDelete', ['id' => $announcement->id]) }}" method="POST">
                            @method("DELETE")
                            @csrf
                            <button type="submit" onclick="return confirm('Точно удалить объявление');" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Удалить
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </x-responsive-container>
    @endforeach
</x-app-layout>
