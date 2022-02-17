<x-app-layout>
    <x-container>
        <div class="header flex justify-between">
            <h1 class="text-2xl">Создание объявлений</h1>
        </div>
        <div class="">
            <form action="{{ route('announcementsStore') }}" method="POST">
                @csrf
                <x-announcement-form :classes="$classes" :announcement="$announcement"></x-announcement-form>
            </form>
        </div>
    </x-container>
    <x-tiny-mce></x-tiny-mce>
</x-app-layout>
