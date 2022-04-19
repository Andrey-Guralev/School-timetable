<x-app-layout>
    <x-container>
        <div>
            <h1 class="text-4xl font-bold">
                Отзывы
            </h1>
        </div>
    </x-container>
    @foreach($feedback as $fb)
        <x-container class="flex flex-col">
            <div>
                <div class="text-2xl font-medium">
                    {{ $fb->first_name }} {{ $fb->second_name }}
                </div>
                <div class="text-sm">
                    {{ $fb->Class->getFullName() }}
                </div>
            </div>
            <div class="ml-4 mt-4 text-xl">
                {{ $fb->text }}
            </div>
            <div class="flex justify-between mt-4">
                <div class="">
                    <form action="{{ route('feedback.destroy', ['id' => $fb->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-900">
                            Удалить
                        </button>
                    </form>
                </div>
                <div class="text-gray-600">
                    {{ $fb->created_at->diffForHumans() }}
                </div>
            </div>
        </x-container>
    @endforeach
</x-app-layout>
