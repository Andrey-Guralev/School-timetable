@php($weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <x-container>
        <h3 class="text-2xl mb-4">Изменения расписания, {{ $class->number }}{{ $class->letter }}</h3>
        <div class="mx-4">
            <div class="">
                <form enctype="multipart/form-data" action="{{ route('storeFileTimetable', ['class_id' => $class->id]) }}" class="" method="POST">
                    @csrf
                    <input type="file" name="file" id="file" required>
                    <button type="submit" class="flex mt-4 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Отправить
                    </button>
                </form>
            </div>
        </div>
        <div class="my-4">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                  <span class="px-2 bg-white text-sm text-gray-500">
                    Или
                  </span>
                    </div>
                </div>
            </div>
        <div class="mx-4">
            <div>
                <form action="" class="min-w-full flex justify-between flex-wrap">
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
                                        @php($s = 1)
                                        @foreach($tt->where('weekday', $i) as $t)
                                                <tr class="bg-white">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                                                        <div class="lesson flex items-center">{{$s}}. <input type="text" value="{{ $t->lesson }}" class="shadow-sm focus:ring-indigo-500 focus:border indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></div>
                                                        <div class="rooms flex"><input type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-16 sm:text-sm border-gray-300 rounded-md"><input type="text" class="ml-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-16 sm:text-sm border-gray-300 rounded-md"></div>
                                                        <button class="delete"></button>
                                                    </td>
                                                </tr>
                                            @php($s++)
                                        @endforeach
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                                                Добавить урок
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endfor
                </form>
            </div>
        </div>
    </x-container>

</x-app-layout>
