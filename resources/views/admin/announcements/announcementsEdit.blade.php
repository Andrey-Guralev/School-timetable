<x-admin-app-layout>
    <x-container>
        <div class="header flex justify-between">
            <h1 class="text-2xl">Изменение объявлений</h1>
        </div>
        <div class="">
            <form action="{{ route('announcementsUpdate', ['id' => $announcement->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="prev_url" value="{{ url()->previous() }}">
                <x-announcement-form :classes="$classes" :announcement="$announcement"></x-announcement-form>
            </form>
        </div>
    </x-container>
    <script>
        tinymce.init({
            selector: '#main-text',
            required: true,
            plugins: 'link lists',
            menubar: '',
            toolbar: 'undo redo | bold italic underline | link | alignleft aligncenter alignright alignjustify | outdent indent | forecolor backcolor removeformat ',
            height: 400,
            toolbar_mode: 'sliding',
            language: 'ru',
        });
    </script>
</x-admin-app-layout>
