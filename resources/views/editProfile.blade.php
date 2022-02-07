<x-app-layout class="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <x-container>
        <div class="header flex justify-between">
            <h3 class="text-xl font-medium">
                Изменение профиля
            </h3>
        </div>
        <form action="{{ route('userStore') }}" method="POST">
            @csrf
            <div class="pt-2">
                <div class="space-y-6 sm:space-y-5">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start t sm:pt-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Имя пользователя
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" value="{{ $user->name }}" name="name" id="name" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start t sm:pt-5">
                        <label for="second_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Фамилия
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" value="{{ $user->second_name }}" name="second_name" id="second_name" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                        <label for="first_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Имя
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" value="{{ $user->first_name }}" name="first_name" id="first_name" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                        <label for="middle_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Отчество
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" value="{{ $user->middle_name }}" name="middle_name" id="middle_name" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Email
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" value="{{ $user->email }}" name="email" id="email" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Сохранить</button>
                </div>
            </div>
        </form>
    </x-container>
</x-app-layout>
