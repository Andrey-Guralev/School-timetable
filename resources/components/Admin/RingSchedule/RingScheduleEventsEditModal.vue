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
                                                    <h1 class="text-3xl bold">Изменение события</h1>

                                                </div>
                                            </header>


                                            <div class="mt-4">
                                                <div class="mb-4">
                                                    <label for="name" class="mb-2">
                                                        Название расписания:
                                                    </label>
                                                    <input v-model="event.name" type="text" name="name" id="name" class="w-1/2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Название" />
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="type" class="mb-2">Тип расписания:</label>
                                                <select v-model="event.ring_schedule_type_id" id="type" name="type" class="mt-1 block w-1/2 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option v-for="type in eventTypes" :value="type.id">{{ type.name }}</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50  px-4 py-3 sm:px-6 flex justify-end">
                                    <button v-on:click="save" type="button" class="ml-4 w-1/3 inline-flex justify-center rounded-md border border-green-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                        Сохранить
                                    </button>
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
    </div>
</template>

<!---->

<script>
    export default {

        data() {
            return {

                open: false,
                date: null,

                id: null,
                event: null,

                result: {
                    id: null,
                    name: null,
                    type: null,
                },

                types: null,
                eventTypes: [],
            }
        },

        methods: {
            getData: async function () {
                this.types = (await axios.get('/ring/types')).data;

                this.types.forEach(function (value, index) {
                    if (value.type === "event") {
                        this.eventTypes.push(value);
                    }
                }.bind(this))
            },

            save: async function () {
                this.result.id = this.id;
                this.result.name = this.event.name;
                this.result.type = this.event.ring_schedule_type_id;
                await axios.patch('/ring/event', this.result).then(function () {
                    this.closeModal();
                    this.$emit('update');
                }.bind(this));
            },

            closeModal: function ()
            {
                this.open = false
                this.id = null
                this.event = null
                this.result = {
                    date: null,
                    name: null,
                    type: null,
                };
                this.types = null;
                this.eventTypes = [];
            },
        },
    }
</script>
