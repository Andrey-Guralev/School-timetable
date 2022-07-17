<template>
    <div class="">
        <header>
            <div class="flex items-center justify-between">
                <div class="text-3xl font-bold">
                    Учителя
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
                        Прикрепленный пользователь
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Фамилия
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Имя
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Отчество
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Должность
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Предметы
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Класс где кл. рук.
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Изменить
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Удалить
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    <tr class="" v-for="teacher in teachers">
                        <td class="px-6 py-4 text-wrap text-sm font-medium text-gray-900 text-center">
                            {{ teacher.user == null ? 'К этому учителю не прикреплен пользователь' : teacher.user.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 text-center">
                            {{ teacher.second_name == null ? teacher.asc_teacher_second_name : teacher.second_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 text-center">
                            {{ teacher.first_name == null ? '-' : teacher.first_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 text-center">
                            {{ teacher.middle_name == null ? '-' : teacher.middle_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 text-center">
                            {{ teacher.type == null ? '-' : teacher.type }}

                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 text-center">
                            <ul>
                                <li v-for="lesson in getLessons(teacher.lessons)">{{ lesson }}</li>
                            </ul>
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500 text-center">
                            {{ getCLass(teacher.class_id) }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                            <button class="text-blue-800 hover:text-blue-900" v-on:click="openEditModal(teacher.id)" v-bind:data-id="teacher.id">Изменить</button>
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                            <button class="text-red-600 hover:text-red-900"  v-on:click="deleteTeacher(teacher.id)">Удалить</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <teacher-create-modal-component ref="createModal" @updateParent="updateTeachers"></teacher-create-modal-component>
        <teacher-edit-modal-component ref="editModal" @updateParent="updateTeachers"></teacher-edit-modal-component>
    </div>
</template>

<script>

import TeacherCreateModalComponent from "./TeacherCreateModalComponent";
import TeacherEditModalComponent from "./TeacherEditModalComponent";

export default {
    components: {
        TeacherCreateModalComponent,
        TeacherEditModalComponent,
    },

    data() {
        return {
            teachers: null,
            classes: null,
            lessons: null,
        };
    },
    methods: {
        getData: async function ()
        {
            this.teachers = (await axios.get('/teacher/get')).data;
                // .then(response => {this.teachers = response.data});
            this.classes = (await axios.get('/classes/get')).data;
                // .then(response => {this.classes = response.data});
            this.lessons = (await axios.get('/lesson/get')).data;
                // .then(response => {this.lessons = response.data});
        },

        openCreateModal: function ()
        {
            this.$refs.createModal.open = true;
            // this.$refs.createModal.getData();
        },

        openEditModal: function (id) {
            this.$refs.editModal.id = id;
            this.$refs.editModal.getData();
            this.$refs.editModal.open = true;
        },

        updateTeachers: async function()
        {
            await axios.get('/teacher/get').then(response => {this.teachers = response.data});
        },

        deleteTeacher: function (id)
        {
            axios.delete('/teacher/' + id)
                .then(response => {this.updateTeachers()})
                .catch(e => {
                    console.log('Какая-то ошибка!')
                });
        },

        getCLass: function (id)
        {
            if (this.classes === null) {
                return;
            }

            let final = "Нет";

            let classes = Object.keys(this.classes).map((key) => this.classes[key]);

            classes.forEach(value => {
                if(value.id === id) {
                   final = value.number + value.letter;
                } else {
                    // final = "Нет";
                }
            });
            return final;
        },

        getLessons: function (l)
        {
            if (this.lessons === null) return;
            if (l === null) return;

            let lessons = Object.keys(this.lessons).map((key) => this.lessons[key]);
            let lId = Object.keys(l).map((key) => l[key]);

            let final = [];

            lId.forEach(function (value1) {

                lessons.forEach(function (value2) {

                    if (Number(value1.id) === Number(value2.id)) {

                        final.push(value2.name);
                    }

                });

            });

            return final;
        }

    },
    mounted() {
        this.getData();
    }
}
</script>

<style scoped lang="scss">

</style>
