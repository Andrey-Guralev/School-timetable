<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    @if(isset($timetable) && session('class'))
        <x-container class="lg:flex lg:flex-wrap sm:block">
            <h1 class="text-3xl">Расписние для твоего класса</h1>
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
        </x-container>
    @endif

    @auth
        <x-container>
            <div class="">
                @if(Auth::user()->type)

                @endif
                @if(Auth::user()->class_id != null)
                    <h2 class="text-3xl">Расписание для вашего класса ({{ Auth::user()->Class->number . Auth::user()->Class->letter }})</h2>
                        @php($weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'])
                        @for($i = 0; $i < 6; $i++)
                            {{--                <div class="py-2 inline-block sm:px-6 sm:w-full lg:w-1/2 lg:px-5">--}}
                            <div class="my-2 inline-block w-full lg:w-6/12 p-3">
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
                @endif
            </div>
        </x-container>
    @endauth

    @if(Auth::guest() && !session('class'))
        <x-container>
            <h1 class="text-4xl font-bold">Добро пожаловать, это расписание Лицея №6</h1>
            <h2 class="sm:mt-4 lg:mt-1.5 text-2xl">Чтобы посмотреть расписание надо <a href="{{ route('classesLogin') }}" class="text-blue-700 underline">войти в класс</a></h2>
        </x-container>
    @endif
</x-app-layout>
