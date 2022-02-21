<x-app-layout>
    <x-container>
        <div class="header flex justify-between">
            <h1 class="text-2xl">Все обьявления</h1>
            <a href="{{ route('announcementsCreate') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700">Добавить обьявление</a>
        </div>
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
                        Для {{ $announcement->Classes->number . $announcement->Classes->letter }}
                    @endif
                </div>
                <div class="buttons mt-2 flex">
                    <a href="{{ route('announcementShow', ['id' => $announcement->id]) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700">
                        Просмотреть
                    </a>
                    @auth
                        @if($announcement->author_id == Auth::user()->id || Auth::user()->type >= 4)
                            <a href="{{ route('announcementsEdit', ['id' => $announcement->id]) }}" class="mx-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700">
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
            </x-container>
        @endforeach
</x-app-layout>
