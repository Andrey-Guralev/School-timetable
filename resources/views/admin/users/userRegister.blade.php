<x-app-layout>
    <x-container>
        <div class="header flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Регистрация нового пользователя</h1>
        </div>
       <div class="form">
           <form action="{{ route('adminRegisterUser') }}" method="POST">
               <div class="w-1/2">
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
                       <x-label for="class" value="Класс, где классный руководитель"></x-label>
                       <select name="class" id="class" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                           <option value="null">Нет такого</option>
                           @foreach($classes as $class)
                               <option value="{{ $class->id }}">
                                   {{ $class->getFullName() }}
                               </option>
                           @endforeach
                       </select>
                   </div>

                   <div class="mt-4">
                       <x-label for="password" value="Пароль" />

                       <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                       <div class=""></div>
                   </div>

                   <div class="mt-4">
                       <x-label for="password_confirmation" value="Подтвердите пароль" />

                       <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
                   </div>

                   <div class="flex items-center justify-end mt-4">
                       <button class="ml-4 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">
                           Зарегистрироваться
                       </button>
                   </div>
               </div>
           </form>
       </div>
    </x-container>
</x-app-layout>
