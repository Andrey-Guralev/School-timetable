<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <x-container>
        <h3 class="text-2xl">Изменения расписания, {{ $class->number }}{{ $class->letter }}</h3>
        <div class="ml-4">
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
        <div class="ml-4">
            <div class="">
                <form action="">

                </form>
            </div>
        </div>
    </x-container>

</x-app-layout>
