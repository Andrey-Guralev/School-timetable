<template>
    <div>
        <h2 class="font-bold text-3xl text-gray-800 leading-tight">
            Обновление расписания
        </h2>
        <div class="ml-8 mt-4">
            <form method="post" enctype="multipart/form-data">
                <div class="">
                    <div class="text-2xl text-bold">
                        Что обновить?
                    </div>
                    <div class="ml-4 mb-4">
                        <div class="">
                            <input id="lessons" type="checkbox" name="lessons" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="lessons">
                                Предметы
                            </label>
                        </div>
                        <div class="">
                            <input id="teachers" type="checkbox" name="teachers" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="teachers">
                                Учителя
                            </label>
                        </div>
                        <div class="">
                            <input id="rooms" type="checkbox" name="rooms" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="rooms">
                                Кабинеты
                            </label>
                        </div>
                        <div class="">
                            <input id="classes" type="checkbox" name="classes" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="classes">
                                Классы
                            </label>
                        </div>
                        <div class="">
                            <input id="timetable" type="checkbox" name="timetable" checked class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="timetable">
                                Расписание
                            </label>
                        </div>
                    </div>
                </div>

                <input v-on:change="getFile" type="file" id="archive-input" name="xml" required>

                <div class="flex items-baseline">
                    <button v-on:click="sendFile" type="submit" data-url="" id="archive-send" class="flex mt-4 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Отправить
                    </button>
                    <span class="ml-4 " id="loading-message"></span>
                </div>
            </form>
        </div>
        <div class="explanation ml-8 mt-4 text-gray-600">* Необходимо импортироваить xml файл</div>
        <timetable-load-modal ref="loadModal"></timetable-load-modal>
        <timetable-load-error-modal ref="errorModal"></timetable-load-error-modal>
        <timetable-load-ok-modal ref="okModal"></timetable-load-ok-modal>
    </div>
</template>

<script>
export default {

    data() {
        return {
            file: null,

            settings: {
                lessons: true,
                teachers: true,
                rooms: true,
                classes: true,
                timetable: true,
            },
        };
    },

    methods: {
        getFile: function (e) {
            this.file = null;

            this.file = e.target.files[0];
        },

        sendFile: function (e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('xml', this.file);
            formData.append('parametrs', JSON.stringify(this.settings))

            this.$refs.loadModal.open = true;

            axios.post('/timetable/edit/xml', formData)
                .then(response => {
                    if (response.data === '') {
                        this.$refs.loadModal.open = false
                        this.$refs.okModal.open = true;
                    } else {
                        this.$refs.loadModal.open = false;
                        this.$refs.errorModal.open = true;
                        this.$refs.errorModal.error = response.data;
                    }
                })
                .catch(error => {
                    this.$refs.loadModal.open = false;
                    this.$refs.errorModal.open = true;
                    this.$refs.errorModal.error = "Неизвестная ошибка";
                });
        }
    },

    mounted() {

    }

}
</script>

<style scoped>

</style>
