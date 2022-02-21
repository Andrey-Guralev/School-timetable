<div>
    <div class="space-y-8 divide-y divide-gray-200">
        <div class="mt-6 flex flex-col">

            <div class="flex flex-col mb-8 w-1/2">
                <label for="title" class="block text-sm font-medium text-gray-700">
                    Заголовок
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="title" id="title" value="{{ $announcement->title ?? null }}" required class="flex-1 focus:ring-blue-700 focus:border-blue-700 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
                </div>
            </div>

            <div class="flex flex-col mb-8 w-1/2">
                <label for="main-text" class="block text-sm font-medium text-gray-700">
                    Текст объявления
                </label>
                <div class="mt-1">
                    <textarea id="main-text" name="main_text" class="">
                        {{ $announcement->text ?? null }}
                    </textarea>
                </div>
            </div>

            <div class="flex flex-col mb-8 w-1/2">
                <label for="type" class="block text-sm font-medium text-gray-700">
                </label>
                <div class="mt-1">
                    @php
                        $type = $announcement->type ?? null;
                        $class_id = $announcement->class_id ?? null;
                    @endphp
                    <select id="type" name="type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-700 focus:border-blue-700 sm:text-sm rounded-md">
                        <option value="school" {{ $type == 0 ? 'selected' : ''}}>Для всей школы</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" @if($type == 0 && $class_id == $class->id) selected @endif>Для {{ $class->number . $class->letter }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Отправить</button>
            </div>
        </div>
    </div>
</div>
