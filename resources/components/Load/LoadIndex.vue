<template>
    <div class="">
        <header>
            <div class="flex items-center justify-between">
                <div class="text-3xl font-bold">
                    Нагрзка
                </div>
                <div>
                    <button type="button" v-on:click="openCreateModal()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900 transition">
                        Создать
                    </button>
                </div>
            </div>
        </header>
        <div class="border rounded-lg mt-4">
            <table class="min-w-full divide-y divide-gray-200 table-fixed max-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Предмет
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Класс
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Учитель
                        </th>
                        <th scope="col" class="w-10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Изменить
                        </th>
                        <th scope="col" class="w-10 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Удалить
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    <tr class="" v-for="load in allLoad">

                        <td class="px-6 py-4 text-wrap text-sm font-medium text-gray-900 text-center">
                            {{ getLesson(load.lesson_id) }}
                        </td>

                        <td class="px-6 py-4 text-wrap text-sm font-medium text-gray-900 text-center">
                            {{ getClass(load.class_id) }}
                        </td>

                        <td class="px-6 py-4 text-wrap text-sm font-medium text-gray-900 text-center">
                            {{ getTeacher(load.teacher_id) }}
                        </td>

                        <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                            <button class="text-blue-800 hover:text-blue-900" v-bind:data-id="load.id" v-on:click="openEditModal">Изменить</button>
                        </td>

                        <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                            <button class="text-red-600 hover:text-red-900"  v-on:click="deleteLoad(load.id)">Удалить</button>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
        <load-create-modal-component ref="createModal" @updateParent="updateLoad"></load-create-modal-component>
        <load-edit-modal-component ref="editModal" @updateParent="updateLoad"></load-edit-modal-component>

    </div>
</template>

<script>
import LoadCreateModalComponent from "./LoadCreateModalComponent";
import LoadEditModalComponent from "./LoadEditModalComponent";

export default {
    name: "LessonsIndex",

    components: {
        LoadCreateModalComponent,
        LoadEditModalComponent,
    },

    data() {
        return {
            allLoad: null,
            lessons: null,
            teachers: null,
            classes: null,
        }
    },

    methods: {
        getData: async function () {
            this.allLoad = (await axios.get('/load/get')).data;

            if (!this.lessons) this.lessons = (await axios.get('/lesson/get')).data;
            if (!this.teachers) this.teachers = (await axios.get('/teacher/get')).data;
            if (!this.classes) this.classes = (await axios.get('/classes/get')).data;
        },

        openCreateModal: function () {
            this.$refs.createModal.open = true;
            this.$refs.createModal.getData();
            // this.$refs.createModal.lessons = this.lessons;
            // this.$refs.createModal.classes = this.classes;
            // this.$refs.createModal.teachers = this.teachers;
        },


        openEditModal: function (e) {
            this.$refs.editModal.id = e.target.dataset.id;
            this.$refs.editModal.open = true;
            this.$refs.editModal.getData();
        },

        deleteLoad: async function (id) {
            await axios.delete('load/' + id)
                .then(response => {
                    this.updateLoad();
                })
                .catch(error => {
                    console.log(error);
                });
        },

        updateLoad: function () {
            this.getData();
        },

        getLesson: function (id) {
            let lessons = Object.keys(this.lessons).map((key) => this.lessons[key]);

            let result = 'Ошибка';

            lessons.forEach(function (lesson) {
                if (lesson.id === id) {
                    result = lesson.name;
                }
            })

            return result;
        },

        getTeacher: function (id) {
            let teachers = Object.keys(this.teachers).map((key) => this.teachers[key]);

            let result = 'Ошибка';

            teachers.forEach(function (teacher) {
                if (teacher.id === id) {
                    result = teacher.user.second_name + ' ' + teacher.user.first_name + ' ' + teacher.user.middle_name;
                }
            })

            return result;
        },

        getClass: function (id) {
            let classes = Object.keys(this.classes).map((key) => this.classes[key]);

            let result = 'Ошибка';

            classes.forEach(function (cl) {
                if (cl.id === id) {
                    result = cl.number + cl.letter;
                }
            })

            return result;
        },
    },

    mounted() {
        this.getData();
    },
}
</script>

<style scoped>

</style>
