<x-app-layout>
    <x-container>
        <div class="header">
            <h1 class="text-2xl font-semibold">Расписание звонков</h1>
        </div>
        <form action="{{ route('ringUpdate') }}" method="POST">
            @csrf
{{--            <div class="flex items-center">--}}
{{--                Классный час после:--}}
{{--                <select name="class_hour" class="ml-4 w-1/4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">--}}
{{--                    @for($i = 1; $i <= 6; $i++)--}}
{{--                        <option value="$i">{{ $i }} урока</option>--}}
{{--                    @endfor--}}
{{--                </select>--}}
{{--            </div>--}}

            <div class="flex w-full">
                <div class="w-full">
                    <h1 class="text-2xl">Для 1 смены:</h1>
                    <div class="tables ml-4">
                        <div class="">
                            <h2 class="text-xl mb-2">Понеденльник</h2>
                            <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg mt-2">
                                <table class="monday min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Начало
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Конец
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 6; $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $i }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 0)->where('number', $i)->first()->start_time ?? '' }}" type="time" name="fir_start_time_monday_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 0)->where('number', $i)->first()->end_time ?? '' }}" type="time" name="fir_end_time_monday_{{ $i }}" class=" ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class=" my-4">
                            <h1 class="text-xl mb-2">Обычный день</h1>
                            <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg mt-2">
                                <table class="regular-day min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Начало
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Конец
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 6; $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $i }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 1)->where('number', $i)->first()->start_time ?? '' }}" type="time" name="fir_start_time_regular_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 1)->where('number', $i)->first()->end_time ?? '' }}" type="time" name="fir_end_time_regular_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="">
                            <h1 class="text-xl mb-2">Суббота</h1>
                            <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg mt-2">
                                <table class="sunday min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Начало
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Конец
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 6; $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $i }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 2)->where('number', $i)->first()->start_time ?? '' }}" type="time" name="fir_start_time_sunday_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 2)->where('number', $i)->first()->end_time ?? '' }}" type="time" name="fir_end_time_sunday_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <h1 class="text-2xl">Для 2 смены:</h1>
                    <div class="tables ml-4">
                        <div class="">
                            <h2 class="text-xl mb-2">Понеденльник</h2>
                            <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg mt-2">
                                <table class="monday min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Начало
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Конец
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 6; $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $i }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 3)->where('number', $i)->first()->start_time ?? '' }}" type="time" name="sec_start_time_monday_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 3)->where('number', $i)->first()->end_time ?? '' }}" type="time" name="sec_end_time_monday_{{ $i }}" class=" ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="my-4">
                            <h1 class="text-xl mb-2">Обычный день</h1>
                            <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg mt-2">
                                <table class="regular-day min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Начало
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Конец
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 6; $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $i }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 4)->where('number', $i)->first()->start_time ?? '' }}" type="time" name="sec_start_time_regular_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 4)->where('number', $i)->first()->end_time ?? '' }}" type="time" name="sec_end_time_regular_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="">
                            <h1 class="text-xl mb-2">Суббота</h1>
                            <div class="shadow overflow-hidden border-b border-gray-400 sm:rounded-lg mt-2">
                                <table class="sunday min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Начало
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Конец
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 6; $i++)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $i }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 4)->where('number', $i)->first()->start_time ?? ''}}" type="time" name="sec_start_time_sunday_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <input value="{{ $rings->where('type', 4)->where('number', $i)->first()->end_time ?? '' }}" type="time" name="sec_end_time_sunday_{{ $i }}" class="ml-4 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit"  class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Отправить
            </button>
        </form>
    </x-container>
</x-app-layout>
