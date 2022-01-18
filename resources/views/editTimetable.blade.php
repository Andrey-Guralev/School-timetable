<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <x-container>
        <h3 class="text-xl font-medium">
            Классы
        </h3>
        <div class="ml-8">
            @foreach($classes as $class)
                <a href="{{ route('editFormTimetable', ['class_id' => $class->id]) }}" class="text-blue-600 mr-4">
                    {{$class->number}}{{ $class->letter }}
                </a>
            @endforeach
        </div>
</x-container>

</x-app-layout>
