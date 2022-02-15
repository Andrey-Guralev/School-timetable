<x-app-layout>
    <x-container>
        <div class="header flex justify-between">
            <h1 class="text-2xl">Создание объявлений</h1>
        </div>
        <div class="">
            {{ $errors }}
            <form action="{{ route('announcementsStore') }}" method="POST">
                @csrf
                <div class="space-y-8 divide-y divide-gray-200">
                    <div class="mt-6 flex flex-col">

                        <div class="flex flex-col mb-8 w-1/2">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Заголовок
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="title" id="title" required class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
                            </div>
                        </div>

                        <div class="flex flex-col mb-8 w-1/2">
                            <label for="main-text" class="block text-sm font-medium text-gray-700">
                                Текст объявления
                            </label>
                            <div class="mt-1">
                                <textarea id="main-text" name="main_text" class=""></textarea>
                            </div>
                        </div>

                        <div class="flex flex-col mb-8 w-1/2">
                            <label for="type" class="block text-sm font-medium text-gray-700">
                            </label>
                            <div class="mt-1">
                                <select id="type" name="type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option selected value="school">Для всей школы</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">Для {{ $class->number . $class->letter }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Отправить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-container>
    <x-tiny-mce></x-tiny-mce>
</x-app-layout>
