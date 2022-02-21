<x-app-layout>
    <x-container>
        <div class="header text-2xl font-bold mb-2">
            Изменение расписания звонков
        </div>
        <div>
            <form action="">
                <div>
                    <label for="class_hour_day" class="block font-medium">День когда классный час</label>
                    <select id="class_hour_day" name="class_hour_day" class="mt-1 block w-3/12 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="null">Без классного часа</option>
                        <option value="0" selected>Понедельник</option> {{-- TODO: ПЕРЕДЕЛАТЬ --}}
                        <option value="2">Вторник</option>
                        <option value="3">Среда</option>
                        <option value="4">Четверг</option>
                        <option value="5">Пятница</option>
                        <option value="6">Суббота</option>
                    </select>
                </div>
                <div class="">

                    <div class="class_hour_day mt-4">
                        <span>День когда есть классный час. (Если классного часа нет оставить пустым)</span>
                        <div class="py-2 inline-block w-full sm:px-6 lg:px-5">
                            <div class="shadow overflow-hidden border-b border-gray-300 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Время начала
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Время конца
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Классный час
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" >
                                        @for($i = 0; $i <= 6; $i++)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                                                    {{ $i+1 }}
                                                </td>
                                                <td class="">
                                                    <input type="time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-1/2 sm:text-sm border-gray-300 rounded-md">
                                                </td>
                                                <td class="">
                                                    <input type="time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-1/2 sm:text-sm border-gray-300 rounded-md">
                                                </td>
                                                <td class="">
                                                    <div class="bg-white flex justify-start px-6">
                                                        <button type="button" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" x-data="{ on: false }" aria-pressed="false" :aria-pressed="on.toString()" @click="on = !on" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'bg-blue-600': on, 'bg-gray-200': !(on) }">
                                                            <span class="sr-only">Use setting</span>
                                                            <span aria-hidden="true" class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }"></span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="usually_day mt-4">
                        <span>Обычный день</span>
                        <div class="py-2 inline-block w-full sm:px-6 lg:px-5">
                            <div class="shadow overflow-hidden border-b border-gray-300 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Время начала
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Время конца
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" >
                                        @for($i = 0; $i <= 6; $i++)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                                                    {{ $i+1 }}
                                                </td>
                                                <td class="">
                                                    <input type="time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-1/2 sm:text-sm border-gray-300 rounded-md">
                                                </td>
                                                <td class="">
                                                    <input type="time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-1/2 sm:text-sm border-gray-300 rounded-md">
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="saturday mt-4">
                        <span>Суббота</span>
                        <div class="py-2 inline-block w-full sm:px-6 lg:px-5">
                            <div class="shadow overflow-hidden border-b border-gray-300 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            №
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Время начала
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Время конца
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" >
                                        @for($i = 0; $i <= 6; $i++)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                                                    {{ $i+1 }}
                                                </td>
                                                <td class="">
                                                    <input type="time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-1/2 sm:text-sm border-gray-300 rounded-md">
                                                </td>
                                                <td class="">
                                                    <input type="time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-1/2 sm:text-sm border-gray-300 rounded-md">
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-container>
</x-app-layout>
