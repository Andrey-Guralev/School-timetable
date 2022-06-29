<template>
    <div>
        <div class="" v-if="open">
            <div class="fixed z-40 inset-0 overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <transition enter-active-class="ease-out duration-300" enter-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-class="opacity-100" leave-to-class="opacity-0">
                        <div v-if="open" v-on:click="closeModal" class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                    </transition>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                    <transition enter-active-class="ease-out duration-300" enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200" leave-class="opacity-100 translate-y-0 sm:scale-100" leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <div v-if="open" class="lg:w-1/2 inline-block align-bottom bg-white rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                            <div class="bg-white rounded-lg px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div>

                                    <div class="">

                                        <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                            <header>
                                                <div class="flex justify-between">
                                                    <h1 class="text-3xl bold">События</h1>
                                                    <button @click="openCreateModal" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900 transition">
                                                        Добавить
                                                    </button>
                                                </div>
                                            </header>


                                            <div class="mt-4">
                                                <div class="-my-2 sm:-mx-6 lg:-mx-8" v-if="st">
                                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                            <table class="min-w-full divide-y divide-gray-200">
                                                                <thead class="bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                        Название
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                        Тип расписания
                                                                    </th>
                                                                    <th scope="col" class="relative px-6 py-3">
                                                                        <span class="sr-only">Кнопки</span>
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="bg-white divide-y divide-gray-200" x-max="1">
                                                                    <tr v-for="event in events">
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                            {{ event.name }}
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                            {{ getType(event.id) }}
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                            <button @click="openEditModal(event, event.id)" type="button" class="text-blue-600 text-decoration-underline hover:text-indigo-900">Изменить</button>
                                                                            <button @click="deleteEvent(event.id)" type="button" class="text-red-600 text-decoration-underline hover:text-indigo-900 ml-2">Удалить</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="!st" class="text-2xl">
                                                    В этот день событий нет
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50  px-4 py-3 sm:px-6 flex justify-end">
                                    <button v-on:click="closeModal" type="button" class="ml-4 w-1/3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                        Выйти
                                    </button>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
        <ring-schedule-events-create-modal ref="createModal" @update="updateData"></ring-schedule-events-create-modal>
        <ring-schedule-events-edit-modal ref="editModal" @update="updateData"></ring-schedule-events-edit-modal>
    </div>
</template>

<!---->

<script>
    export default {
        data() {
            return {
                open: false,

                date: null,

                st: false,

                events: null,
            }
        },

        methods: {
            getData: async function () {
                this.events = (await axios.get('/ring/event/' + this.date)).data;

                if(this.events.length !== 0) this.st = true;

            },

            updateData: function () {
                this.getData();
                this.open = true;
                this.$emit('update')
            },

            getType: function (id) {
                let event = this.events.find(event => event.id === id);

                return event.ring_schedule_type.name;
            },

            openCreateModal: function () {
                this.$refs.createModal.date = this.date;
                this.$refs.createModal.getData();
                this.$refs.createModal.open = true;
                this.open = false;
            },

            openEditModal: function (event, id) {
                this.$refs.editModal.id = id;
                this.$refs.editModal.event = event;
                this.$refs.editModal.getData();
                this.$refs.editModal.open = true;
                this.open = false;
            },

            deleteEvent: async function (id) {
                await axios.delete('/ring/event/' + id).then(function () {
                    this.updateData();
                }.bind(this));
            },

            closeModal: function ()
            {
                this.open = false;
                this.st = false;
                this.date = null;
                this.events = null;
            },
        },
    }
</script>
