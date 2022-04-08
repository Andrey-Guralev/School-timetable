<template>
    <div class="">
        <header>
            <div class="flex items-center justify-between">
                <div class="text-3xl font-bold">
                    Предметы
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
                        Название
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

                <tr class="" v-for="lesson in lessons">
                    <td class="px-6 py-4 text-wrap text-sm font-medium text-gray-900 text-center">
                        {{ lesson.name }}
                    </td>

                    <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                        <button class="text-blue-800 hover:text-blue-900" v-bind:data-id="lesson.id" v-on:click="openEditModal">Изменить</button>
                    </td>

                    <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                        <button class="text-red-600 hover:text-red-900"  v-on:click="deleteLesson(lesson.id)">Удалить</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <lesson-create-modal-component ref="createModal" @updateParent="updateLessons"></lesson-create-modal-component>
        <lesson-edit-modal-component ref="editModal" @updateParent="updateLessons"></lesson-edit-modal-component>

    </div>
</template>

<script>
import LessonCreateModalComponent from "./LessonCreateModalComponent";
import LessonEditModalComponent from "./LessonEditModalComponent";

export default {
    name: "LessonsIndex",

    components: {
        LessonCreateModalComponent,
        LessonEditModalComponent,
    },

    data() {
        return {
            lessons: Object,
        }
    },

    methods: {
        getLessons: async function () {
            this.lessons = (await axios.get('/lesson/get')).data;
        },

        openCreateModal: function () {
            this.$refs.createModal.open = true;
        },

        openEditModal: function (e) {
            this.$refs.editModal.id = e.target.dataset.id;
            this.$refs.editModal.open = true;
            this.$refs.editModal.getData();
        },

        deleteLesson: async function (id) {
            await axios.delete('lesson/' + id)
                .then(response => {
                    this.updateLessons();
                })
                .catch(error => {
                    console.log(error);
                });
        },

        updateLessons: function () {
            this.getLessons();
        }
    },

    mounted() {
        this.getLessons();
    },
}
</script>

<style scoped>

</style>
