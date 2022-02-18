<x-guest-layout>

    <x-auth-card>
        <div class="head">
            <h1 class="text-3xl font-bold">Регистрация</h1>
        </div>

        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('index') }}">
            Вернуться на главную
        </a>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <x-label for="name" value="Имя пользователя" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="second_name" value="Фамилия" />

                <x-input id="second_name" class="block mt-1 w-full" type="text" name="second_name" :value="old('second_name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="first_name" value="Имя" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="middle_name" value="Отчество" />

                <x-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" autofocus />
            </div>

            <div class="mt-4">
                <x-label for="email" value="Email" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Пароль" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="Подтвердите пароль" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        Уже зарегистрированны?
                </a>

                <x-button class="ml-4">
                    Зарегистрироваться
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
