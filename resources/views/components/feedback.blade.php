<div >
    <div>
        <h1 class="text-3xl font-bold" style="color: #003A80">Оставить отзыв</h1>
    </div>
    <div class="">
        @if ($errors->any())
            <div {{ $attributes }}>
                <div class="font-medium text-red-600">
                    Что то пошло не так!
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('feedback.create') }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <div class="flex flex-col mt-4">
                    <label for="first-name" class="mt-4 block text-sm font-medium text-gray-700">
                        Имя:
                    </label>
                    <input type="text" name="first_name" id="first-name" placeholder="Имя" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="flex flex-col mt-4">
                    <label for="second-name" class="block text-sm font-medium text-gray-700">
                        Фамилия:
                    </label>
                    <input type="text" name="second_name" id="second-name" placeholder="Фамилия" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="flex flex-col mt-4">
                    <label for="class" class="block text-sm font-medium text-gray-700">
                        Класс:
                    </label>
                    <select name="class" id="class" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                        <option value="0">Учитель</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->getFullName() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col mt-4">
                    <label for="text" class="block text-sm font-medium text-gray-700">
                        Отзыв и предложение:
                    </label>
                    <textarea placeholder="Текст" name="text" id="text" cols="30" rows="10" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    <span class="block text-sm font-medium text-gray-700 mt-1">
                        * Напишите отзыв и несколько пожеланий для расписания
                    </span>
                </div>

                <div class="mt-4">
                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
                        Отправить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
