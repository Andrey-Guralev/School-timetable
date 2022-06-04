<x-admin-app-layout>
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
                <a href="{{ route('timetable.forClass', ['id' => $Class->id]) }}" class="@if($Class->id == $class->id) bg-blue-700  @else bg-blue-600 @endif mb-2 mx-1 block h-8 px-2 flex justify-center items-center rounded text-white hover:bg-blue-700 transition ">
                    {{ $Class->getFullName() }}
                </a>
            @endforeach
        </div>

        <class-timetable-index class-id="{{ $class->id }}"></class-timetable-index>
    </x-responsive-container>
</x-admin-app-layout>
