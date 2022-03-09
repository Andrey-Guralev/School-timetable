<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>
    <x-responsive-container class="flex flex-wrap sm:w-full lg:w-9/12">
        <div class="w-full">
            <h1 class="text-xl">Расписание для класса {{ $class->getFullName() }}</h1>
            <a href="{{ \App\Providers\RouteServiceProvider::HOME }}" class="mb-4 text-blue-800 underline">На главную</a>
        </div>
        <div class="ml-4 flex flex-wrap w-full my-4">
            @foreach($classes as $Class)
                <a href="{{ route('timetableForClass', ['id' => $Class->id]) }}" class="@if($Class->id == $class->id) bg-blue-700  @else bg-blue-600 @endif mb-2 mx-1 block h-8 px-2 flex justify-center items-center rounded text-white hover:bg-blue-700 transition ">
                    {{ $Class->getFullName() }}
                </a>
            @endforeach
        </div>
        @php($weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'])
        @for($i = 0; $i < 6; $i++)
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
</x-app-layout>
