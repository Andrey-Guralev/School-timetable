<x-app-layout>
{{--    <div class="mt-4 mx-auto bg-white rounded-md p-6 lg:flex lg:flex-wrap lg:w sm:block sm:w-full">--}}
{{--        <div class="header flex justify-between">--}}
{{--            <h1 class="text-2xl">Создание объявлений</h1>--}}
{{--        </div>--}}
{{--        <div class="">--}}
{{--            <form action="{{ route('announcementsStore') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="prev_url" value="{{ url()->previous() }}">--}}
{{--                <x-announcement-form :classes="$classes"></x-announcement-form>--}}
{{--                <announcements-create-component></announcements-create-component>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
    <x-responsive-container class="flex flex-col">
        <div class="header flex justify-between">
            <h1 class="text-2xl">Создание объявлений</h1>
        </div>
        <div class="errors">
            @if ($errors->any())
                <div>
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
        </div>
        <div class="">
             <announcements-create-component csrf="{{ csrf_token() }}" prev="{{ url()->previous() }}"></announcements-create-component>
        </div>
    </x-responsive-container>
</x-app-layout>


