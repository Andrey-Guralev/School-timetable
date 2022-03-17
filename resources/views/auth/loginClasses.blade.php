<x-guest-layout>
    <x-auth-card>

        <div class="head">
            <h1 class="text-3xl font-bold">Вход в класс</h1>
        </div>

        <div class="mb-2">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('index') }}">
                Вернуться на главную
            </a>
        </div>

        @if(session('error'))
            <div class="rounded-md bg-red-50 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-times-circle text-red-500 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            {{ session('error') }}
                        </h3>
                    </div>
                </div>
            </div>
        @endif
            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" x-description="Heroicon name: solid/x-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-wrap">
                @foreach($classes as $class)
                    <form method="POST" class="m-0.5" action="{{ route('classesLogin') }}">
                        @csrf
                        <input type="hidden" name="class" value="{{ $class->id }}">
                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                            {{ $class->getFullName() }}
                        </button>
                    </form>
                @endforeach
            </div>

{{--        <form method="POST" action="{{ route('classesLogin') }}">--}}
{{--            @csrf--}}
{{--            <div>--}}
{{--                <div>--}}
{{--                    <label for="class" class="block text-sm font-medium text-gray-700">Класс</label>--}}
{{--                    <select id="class" name="class" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-800 focus:border-blue-700 sm:text-sm rounded-md">--}}
{{--                        <option value="">Выбрать</option>--}}
{{--                        @foreach($classes as $class)--}}
{{--                            <option value="{{ $class->id }}">{{ $class->number }}{{$class->letter}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <x-button class="ml-3">--}}
{{--                    Войти--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
    </x-auth-card>
</x-guest-layout>
