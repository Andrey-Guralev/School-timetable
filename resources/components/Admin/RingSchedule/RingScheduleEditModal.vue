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
                    <div v-if="open" class="lg:w-1/2 inline-block align-bottom bg-white rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <form>
                            <div class="bg-white rounded-lg px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div>
                                    <div class="">

                                        <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                            <header>
                                                <div class="flex justify-between">
                                                    <h1 class="text-3xl bold">Изменить расписание звонков</h1>
                                                </div>
                                            </header>
                                            <div class="mt-4">
                                                <div class="mb-4">
                                                    <label for="name" class="mb-2">
                                                        Название расписания:
                                                    </label>
                                                    <input type="text" v-model:value="type.name" name="name" id="name" class="w-1/2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Название" />
                                                </div>
                                                <div class="mb-4">
                                                    <label for="shift" class="mb-2">Смена:</label>
                                                    <select v-model="type.shift" id="shift" name="shift" class="mt-1 block w-1/2 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="shift" class="mb-2">Тип расписания:</label>
                                                    <select v-model="type.type" id="shift" name="shift" class="mt-1 block w-1/2 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                        <option value="regular">Обычное</option>
                                                        <option value="saturday">Суббота</option>
                                                        <option value="class_hour">Для дней с классным часом</option>
                                                        <option value="event">Для событий</option>
                                                    </select>
                                                </div>

                                                <div class="mb-4" v-for="num in numOfLessons">
                                                    <div class="mb-2">
                                                        <span>
                                                            {{ num }} урок:
                                                        </span>
                                                        <div class="ml-4">
                                                            <div class="flex items-center mb-2">
                                                                <label :for="'start-time-' + num" class="mr-2 ">Начало:</label>
                                                                <input :id="'start-time-' + num" :name="'start-time-' + num" v-bind:value="getValue(num, 1)" type="time" :class="num + ' ring-schedule start w-2/12 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md'">
                                                            </div>
                                                            <div class="flex items-center">
                                                                <label :for="'end-time-' + num" class="mr-2 text-center">Конец:</label>
                                                                <input :id="'end-time-' + num" :name="'end-time-' + num" v-bind:value="getValue(num, 2)" type="time" :class="num + ' ring-schedule end w-2/12 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md'">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50  px-4 py-3 sm:px-6 flex justify-end">
                                    <button v-on:click="save" type="button" class="ml-4 w-1/3 inline-flex justify-center rounded-md border border-green-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                        Сохранить
                                    </button>
                                    <button v-on:click="back" type="button" class="ml-4 w-1/3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                        Назад
                                    </button>
                                </div>
                            </div>
                        </form>
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

                numOfLessons: 7,
                typeId: null,
                type: null,

                result: {
                    id: null,
                    name: null,
                    shift: null,
                    type: null,
                    ringSchedule: {
                        1: {
                            start_time: null,
                            end_time: null,
                        },
                        2: {
                            start_time: null,
                            end_time: null,
                        },
                        3: {
                            start_time: null,
                            end_time: null,
                        },
                        4: {
                            start_time: null,
                            end_time: null,
                        },
                        5: {
                            start_time: null,
                            end_time: null,
                        },
                        6: {
                            start_time: null,
                            end_time: null,
                        },
                        7: {
                            start_time: null,
                            end_time: null,
                        },
                    }
                },
            }
        },

        methods: {
            save: function () {
                this.result.id = this.type.id;
                this.result.name = this.type.name;
                this.result.type = this.type.type;
                this.result.shift = this.type.shift;

                let inputs = document.querySelectorAll('.ring-schedule');

                for (let i = 1; i <= 7; i++) {
                    let q = [];

                    inputs.forEach(function (v) {
                        if (v.classList.contains(i)) {
                            q.push(v);
                        }
                    }.bind([this, i, q]))

                    this.result.ringSchedule[i].start_time = q[0].value;
                    this.result.ringSchedule[i].end_time = q[1].value;
                }

                axios.patch('/ring/update', this.result)
                    .then(function (response) {
                        this.$emit('update');
                        this.open = false;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error)
                    });

            },



            getValue: function (num, inputType) {
                let result = null;
                this.type.ring_schedule.forEach(function (value) {
                    if (value.number === num) {
                        if (inputType === 1) {
                            result = value.start_time;
                        } else if(inputType === 2) {
                            result = value.end_time;
                        }
                    }
                });
                return result;
            },

            back: function () {
                this.closeModal();
                this.$emit('back');
            },

            closeModal: function ()
            {
                this.open = false;
                this.typeId = null;
                this.type = null;
            },
        },
    }
</script>
