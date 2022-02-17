<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>
    <x-container class="lg:flex lg:flex-wrap sm:block">
        <div class="w-full">
            <h1 class="text-3xl">Здраствуйте, {{ Auth::user()->first_name ?? Auth::user()->name }} {{Auth::user()->second_name ?? ''}}</h1>
        </div>
        @if(Auth::user()->class_id != null && $timetable != null)
            <div class="w-full ml-2">
                <h2 class="text-2xl">Расписние для вашего класса</h2>
            </div>
            @php($weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'])
            @for($i = 0; $i < 6; $i++)
                <div class="py-2 inline-block sm:px-6 sm:w-full lg:w-1/2 lg:px-5">
                    <div class="shadow border-b border-gray-300 ">
                        <table class="min-w-full divide-y divide-gray-200">
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
                </div>
            @endfor
        @endif
{{--        Расписание других классов--}}
    </x-container>

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
                    Для {{ $announcement->Classes->number ?? '' }}{{ $announcement->Classes->letter ?? '' }}
                @endif
            </div>
            <div class="buttons mt-2">
                <a href="{{ route('announcementShow', ['id' => $announcement->id]) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Читать
                </a>
            </div>
        </x-container>
    @endforeach

</x-app-layout>
