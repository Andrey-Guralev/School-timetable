<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <x-container>
        <div class="header flex justify-between">
            <h3 class="text-xl font-medium">
                Выбрать класс для изменения расписания
            </h3>
{{--            <a href="{{ route('editClasses') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Изменить классы</a>--}}
        </div>
        <div class="ml-8 mt-4">
            @foreach($classes as $class)
                <a href="{{ route('editFormTimetable', ['class_id' => $class->id]) }}" class="text-blue-600 mr-4">
                    {{$class->number}}{{ $class->letter }}
                </a>
            @endforeach
        </div>
        <div class="explanation ml-8 mt-4 text-gray-600">* Чтобы изменить расписание, надо выбрать класс</div>
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
        <div class="header flex justify-between">
            <h3 class="text-xl font-medium">
                Изменить для всех классов сразу
            </h3>
        </div>
        <div id="error-message" class="mt-4 ml-8">

        </div>
        <div class="ml-8 mt-4">
            <form action="{{ route('storeArchiveTimetable') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" id="archive-input" name="archive" required>
                <div class="flex items-baseline">
                    <button type="submit" data-url="{{ route('storeArchiveTimetable') }}" id="archive-send" class="flex mt-4 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Отправить
                    </button>
                    <span class="ml-4 " id="loading-message"></span>
                </div>
            </form>
        </div>
        <div class="explanation ml-8 mt-4 text-gray-600">* Необходимо импортироваить zip архив</div>

    </x-container>
</x-app-layout>
