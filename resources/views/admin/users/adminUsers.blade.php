<x-admin-app-layout>
    <x-container>
        <div class="header flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Пользователи</h1>
            <a href="{{ route('adminRegisterUserPage') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-800 transition hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900">
                Зарегистрировать нового пользователя
            </a>
        </div>
        <div class="crud">
            <div class="shadow overflow-auto sm:overflow-hidden border-b border-gray-400 sm:rounded-lg mt-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Имя пользователя
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Фамилия
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Имя
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Отчество
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Тип
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Кнопки
                        </th>
                    </tr>
                    </thead>
                    <tbody x-max="2">
                        @foreach($users as $user)
                            <tr class="bg-white" x-description="Odd row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->second_name ?? "-" }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->first_name ?? "-" }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->middle_name ?? "-" }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @switch($user->type)
                                        @case(0)
                                            Не определен
                                            @break
                                        @case(1)
                                            Студент
                                            @break
                                        @case(2)
                                            Учитель
                                            @break
                                        @case(4)
                                            Админ
                                            @break
                                        @default
                                            Какая-то ошибка
                                            @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex">
                                    <a href="{{ route('changeUserType', ["id" => $user->id, 'type' => 2]) }}" class="mr-2">Учитель</a>
{{--                                    <a href="{{ route('changeUserType', ["id" => $user->id, 'type' => 3]) }}" class="mr-2">Менеджер</a>--}}
                                    <a href="{{ route('changeUserType', ["id" => $user->id, 'type' => 4]) }}" class="mr-2">Админ</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-container>
</x-admin-app-layout>
