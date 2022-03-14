<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>


    @if(isset($timetable) && session('class'))
        <x-responsive-container class="flex flex-wrap sm:w-full lg:w-9/12">
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
                        <?php
                            if ($class->shift = 0) {
                                if($i == 0) {
                                    $type = $types[0];
                                } elseif ($i == 5) {
                                    $type = $types[2];
                                } else {
                                    $type = $types[1];
                                }
                            } else {
                                if ($i == 0) {
                                    $type = $types[0];
                                } elseif ($i == 5) {
                                    $type = $types[2];
                                } elseif ($i == 4) {
                                    $type = $types[3];
                                } else {
                                    $type = $types[1];
                                }
                            }
                            ?>
                        <tr class="bg-white">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex justify-between">
                                    <span class="lesson">{{$s}}. {{ $t->lesson }}</span>
                                    <span class="rooms">{{ $t->room_1 }}{{ $t->room_2 != null ? '/' . $t->room_2 : null}}</span>
                                </div>
                                @if($ringSchedule)
                                    <div class="ml-3 text-gray-600">
                                        {{ substr($ringSchedule->where('type', $type)->where('number', $s)->first()->start_time ?? '', 0, 5) }}-{{ substr($ringSchedule->where('type', $type)->where('number', $s)->first()->end_time ?? '', 0, 5) }}
                                    </div>
                                @endif
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
        <x-responsive-container class="sm:w-full lg:w-9/12">
            <h1 class="text-3xl">Объявления</h1>
        </x-responsive-container>

        @foreach($announcements as $announcement)
            <x-responsive-container class="sm:w-full lg:w-9/12">
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
                        Для твоего класса
                    @endif
                </div>
                <div class="buttons mt-2">
                    <a href="{{ route('announcementShow', ['id' => $announcement->id]) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
                        Просмотреть
                    </a>
                </div>
            </x-responsive-container>
        @endforeach
    @endif
</x-app-layout>
