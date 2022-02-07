<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    @if(isset($timetable) && session('class'))
        <x-container class="flex flex-wrap">
            @php($weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'])
            @for($i = 0; $i < 6; $i++)
                <div class="py-2 inline-block w-1/2 sm:px-6 lg:px-5">
                    <div class="shadow overflow-hidden border-b border-gray-300 sm:rounded-lg">
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
        </x-container>
    @endif

    @auth
        <x-container>
            <h1 class="text-2xl font-medium">Расписние</h1>
            <div>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
{{--                @if(Auth::user()->type == 2) --}}
{{--                    Расписание для учителя --}}
{{--                @endif --}}
            </div>
        </x-container>
    @endauth

    @guest

    @endguest
</x-app-layout>
