<template>
    <div class="">
        <header>
            <div class="flex items-center justify-between">
                <div class="text-3xl font-bold">
                    Кабинеты
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
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Класс
                        </th>
                        <th scope="col" class="px-6 py-3 w-10 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Изменить
                        </th>
                        <th scope="col" class="px-6 py-3 w-10 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Удалить
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    <tr class="" v-for="room in rooms">

                        <td class="px-6 py-4 text-wrap text-sm font-medium text-gray-900 text-center">
                            {{ room.name }}
                        </td>

                        <td class="px-6 py-4 text-wrap text-sm font-medium text-gray-900 text-center">
                            {{ getClass(room.class_id) }}
                        </td>

                        <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                            <button class="text-blue-800 hover:text-blue-900" v-bind:data-id="room.id" v-on:click="openEditModal">Изменить</button>
                        </td>

                        <td class="px-6 py-4 whitespace-normal text-right text-sm font-medium">
                            <button class="text-red-600 hover:text-red-900"  v-on:click="deleteRoom(room.id)">Удалить</button>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
        <room-create-modal-component ref="createModal" @updateParent="updateRooms"></room-create-modal-component>
        <room-edit-modal-component ref="editModal" @updateParent="updateRooms"></room-edit-modal-component>

    </div>
</template>

<script>
import RoomCreateModalComponent from "./RoomCreateModalComponent";
import RoomEditModalComponent from "./RoomEditModalComponent";

export default {
    name: "RoomIndex",

    components: {
        RoomCreateModalComponent,
        RoomEditModalComponent,
    },

    data() {
        return {
            rooms: null,
            classes: [],
        }
    },

    methods: {
        getData: async function () {
            this.classes = (await axios.get('/classes/get')).data;

            this.rooms = (await axios.get('/room/get')).data;
        },

        openCreateModal: function () {
            this.$refs.createModal.open = true;
            this.$refs.createModal.getData();
        },


        openEditModal: function (e) {
            this.$refs.editModal.open = true;
            this.$refs.editModal.id = e.target.dataset.id;
            this.$refs.editModal.getData();
        },

        deleteRoom: async function (id) {
            await axios.delete('room/' + id)
                .then(() => {
                    this.updateLoad();
                })
                .catch(error => {
                    console.log(error);
                });
        },

        updateRooms: function () {
            this.getData();
        },

        getClass: function (id) {
            let result = 'Нет';

            this.classes.forEach(function (cl) {
                console.log(cl)
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
