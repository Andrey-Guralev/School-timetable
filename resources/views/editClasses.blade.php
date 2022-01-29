<x-app-layout class="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <x-container>
        <div class="header flex justify-between">
            <h3 class="text-xl font-medium">
                Изменение классов
            </h3>
        </div>
        <div class="ml-8 flex">
            @foreach($classes as $class)
                <button type="button" class="class-button id-{{ $class->id }} text-blue-600 mr-4" data-id="{{ $class->id }}" data-number="{{ $class->number }}" data-letter="{{ $class->letter }}" data-save-url="{{ route('updateClasses') }}" data-delete-url="{{ route('destroyClasses', ['class_id' => $class->id]) }}">
                    {{ $class->number }}{{ $class->letter }}
                </button>
            @endforeach
        </div>
    </x-container>

    <div class="modal hidden" id="modal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed opacity-class inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75">
                </div>
            </div>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form>
                    <div>
                        <div class="head flex justify-between mb-2">
                            <h2>Изменить класс</h2>
                            <button type="button" id="close-button" class="close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="flex">
                            <input type="text" id="number-input" class="number w-3/12 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Цифра">
                            <input type="text" id="letter-input" class="letter w-3/12 ml-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Буква">
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 flex justify-between">
                        <button type="button" id="delete-button" class=" w-5/12 inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                            Удалить
                        </button>
                        <button type="submit" id="save-button" class="open w-5/12 inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
