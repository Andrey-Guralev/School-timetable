<template>
    <div class="w-11/12">
        <form action="" method="POST" id="form">
            <input type="hidden" name="_token" v-bind:value="csrf">
            <input type="hidden" name="prev_url" v-bind:value="prev">

            <div class="mt-6 flex flex-col">

                <div class="flex flex-col mb-8 w-full">
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Заголовок
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input v-model="title" type="text" name="title" id="title" value="" required class="flex-1 focus:ring-blue-700 focus:border-blue-700 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
                    </div>
                </div>

                <div class="flex flex-col mb-8 w-full">
                    <label for="main-text" class="block text-sm font-medium text-gray-700">
                        Текст объявления
                    </label>
                    <div class="mt-1">
                        <textarea id="main-text" name="main_text" class=""></textarea>
                    </div>
                </div>

                <div class="flex flex-col mb-8 w-full">
                    <label for="type" class="block text-sm font-medium text-gray-700">
                        Класс
                    </label>
                    <div class="mt-1">
                        <select v-model="type" id="type" name="type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-700 focus:border-blue-700 sm:text-sm rounded-md">
                            <option value="school">Для всей школы</option>
                            <option v-for="cl in classes" v-bind:value="cl.id">Для {{ cl.number }}{{ cl.letter }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex">
                    <button type="submit" v-on:submit="sendForm" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Отправить</button>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: [
        'csrf',
        'prev'
    ],
    data() {
        return {
            classes: null,
            title: null,
            main_text: null,
            type: null,
        }
    },
    methods: {
        tinyMceInit: function () {
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
        },

        getClasses: async function() {
            axios.get('/classes/get')
                .then(response => (this.classes = response.data));

        },

        sendForm: function (e) {
            e.preventDefault();

            document.querySelector('#form').submit();
        }
    },
    mounted() {
        this.tinyMceInit();
        this.getClasses();
    }
}
</script>

<style lang="sass" scoped>

</style>
