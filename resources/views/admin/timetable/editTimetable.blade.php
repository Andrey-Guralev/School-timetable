<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <x-container>
        <div class="header flex justify-between">
            <h3 class="text-xl font-medium">
                Классы
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
</x-container>

</x-app-layout>
