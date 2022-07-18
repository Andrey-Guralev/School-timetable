<x-admin-app-layout>
    <x-container>
{{--        <div>--}}
{{--            <h2 class="font-bold text-3xl text-gray-800 leading-tight">--}}
{{--                Обновление расписания--}}
{{--            </h2>--}}
{{--            <div class="ml-8 mt-4">--}}
{{--                <form action="{{ route('timetable.storeXml') }}" method="post" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <div class="">--}}
{{--                        <div class="text-2xl text-bold">--}}
{{--                            Что обновить?--}}
{{--                        </div>--}}
{{--                        <div class="ml-4 mb-4">--}}
{{--                            <div class="">--}}
{{--                                <input id="lessons" type="checkbox" name="lessons" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">--}}
{{--                                <label for="lessons">--}}
{{--                                    Предметы--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <input id="teachers" type="checkbox" name="teachers" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">--}}
{{--                                <label for="teachers">--}}
{{--                                    Учителя--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <input id="rooms" type="checkbox" name="rooms" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">--}}
{{--                                <label for="rooms">--}}
{{--                                    Кабинеты--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <input id="groups" type="checkbox" name="groups" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">--}}
{{--                                <label for="groups">--}}
{{--                                    Группы--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <input id="classes" type="checkbox" name="classes" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">--}}
{{--                                <label for="classes">--}}
{{--                                    Классы--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <input id="load" type="checkbox" name="load" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">--}}
{{--                                <label for="load">--}}
{{--                                    Нагрузка--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <input id="timetable" type="checkbox" name="timetable" checked class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">--}}
{{--                                <label for="timetable">--}}
{{--                                    Расписание--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <input type="file" id="archive-input" name="xml" required>--}}

{{--                    <div class="flex items-baseline">--}}
{{--                        <button type="submit" data-url="" id="archive-send" class="flex mt-4 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">--}}
{{--                            Отправить--}}
{{--                        </button>--}}
{{--                        <span class="ml-4 " id="loading-message"></span>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="explanation ml-8 mt-4 text-gray-600">* Необходимо импортироваить xml файл</div>--}}
{{--        </div>--}}

        <timetable-index-component />
    </x-container>
</x-admin-app-layout>
