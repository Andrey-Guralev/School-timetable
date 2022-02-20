<x-app-layout>


    @auth
        <x-responsive-container class="flex flex-wrap sm:w-full lg:w-9/12">
            <div class="block w-full">
                <h2 class="text-3xl">Расписание для вашего класса ({{ Auth::user()->Class->number  . Auth::user()->Class->letter }})</h2>
            </div>
            @php($weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'])
            @for($i = 0; $i < 6; $i++)
{{--                <div class="py-2 inline-block sm:px-6 sm:w-full lg:w-1/2 lg:px-5">--}}
                 <div class="my-2 inline-block w-full lg:w-1/2 p-4 ">
                    <table class="min-w-full divide-y divide-gray-200 shadow border-b border-gray-300 ">
                        <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ $weekdays[$i] }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" >
                        <?php $s = 1?>
                        @foreach($timetable->where('weekday', $i) as $t)
                            <tr class="bg-white">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                                    <span class="lesson">{{$s}}. {{ $t->lesson }}</span>
                                    <span class="rooms">{{ $t->room_1 }}{{ $t->room_2 != null ? '/' . $t->room_2 : null}}</span>
                                </td>
                            </tr>
                            <?php $s++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
{{--                </div>--}}
            @endfor
        </x-responsive-container>
    @endauth

        <x-container class="flex justify-between">
            <h1 class="text-3xl">Объявления</h1>
            <a href="{{ route('announcementsCreate') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Добавить обьявление</a>
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
                    <a href="{{ route('announcementShow', ['id' => $announcement->id]) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Просмотреть
                    </a>
                    @auth()
                        @if($announcement->author_id == Auth::user()->id || Auth::user()->type > 4)
                            <a href="{{ route('announcementsEdit', ['id' => $announcement->id]) }}" class="mr-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
