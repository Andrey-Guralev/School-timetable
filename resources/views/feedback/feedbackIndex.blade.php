<x-app-layout>
    <x-container>
        <div class="lg:flex justify-between sm:block">
           <div>
               <h1 class="text-4xl font-bold">
                   Все отзывы
               </h1>
               <div class="">
                   <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('index') }}">
                       Вернуться на главную
                   </a>
               </div>
           </div>

            <div class="lg:mt-0 mt-4">
                <a href="{{ route('feedback.createPage') }}" class="bold mb-2 mx-1 bg-blue-600 block h-8 px-4 py-2 flex justify-center items-center rounded text-white hover:bg-blue-700 transition">
                    Оставить отзыв
                </a>
            </div>
        </div>
    </x-container>
    @foreach($feedback as $fb)
        <x-container class="flex flex-col">
            <div>
                <div class="text-2xl font-medium">
                    {{ $fb->first_name }} {{ $fb->second_name }}
                </div>
                <div class="text-sm">
                    {{ $fb->class_id != 0 ? $fb->Class->getFullName() : "Учитель" }}
                </div>
            </div>
            <div class="ml-4 mt-4 text-xl">
                {{ $fb->text }}
            </div>
            <div class="flex justify-between mt-4">
                <div class="text-gray-600">
                    {{ $fb->created_at->diffForHumans() }}
                </div>
            </div>
        </x-container>
    @endforeach
    <x-container>
        {{ $feedback->links() }}
    </x-container>
</x-app-layout>
