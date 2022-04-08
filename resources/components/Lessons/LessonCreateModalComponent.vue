<template>
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
                    <div v-if="open" class="lg:w-1/2 inline-block align-bottom bg-white rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                        <div class="bg-white rounded-lg px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div>

                                <div class="">

                                    <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                        <header>
                                            <div>
                                                <h1 class="text-3xl bold">Создание предмета</h1>
                                            </div>
                                        </header>


                                        <div class="mt-2">
                                            <label for="lesson" class="block text-sm font-medium text-gray-700">
                                                Название
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" v-model="name" name="lesson" id="lesson" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Название">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50  px-4 py-3 sm:px-6 flex justify-end">
                                <button v-on:click="sendChanges" type="submit" class="w-1/3 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Сохранить
                                </button>
                                <button v-on:click="closeModal" type="button" class="ml-4 w-1/3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                    Отмена
                                </button>
                            </div>
                        </div>
                    </div>
                </transition>
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

                name: null,
            }
        },

        methods: {
            openModal: function (type)
            {
                if (type === 1) {
                    this.open = false
                    this.$emit('openCreateModals', 0)
                } else {
                    this.open = false
                    this.$emit('openCreateModals', 1)
                }

                this.open = false
            },

            sendChanges: function (e) {
                e.preventDefault();

                axios.post('/lesson/', {'name': this.name})
                    .then(response => {
                        this.$emit('updateParent');
                        this.closeModal();
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },

            closeModal: function ()
            {
                this.name = null
                this.open = false;
            },
        },
    }
</script>
