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
                    <form>
                        <div v-if="open" class="lg:w-1/2 inline-block align-bottom bg-white rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                            <div class="bg-white rounded-lg px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                        <header>
                                            <div>
                                                <h1 class="text-3xl bold">Создание учителя</h1>
                                            </div>
                                        </header>

                                        <div v-if="errors[0]" class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                            <span class="text-red-600 text-xl font-bold">Какая-то ошибка!</span>
                                            <div>
                                                <ul class="ml-8">
                                                    <li v-for="error in errors" class="text-red-600 list-disc">{{ error }}</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="login" class="block text-sm font-medium text-gray-700">
                                                Логин
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" v-model="teacher.name" name="login" id="login" autocomplete="none" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="login">
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="email" class="block text-sm font-medium text-gray-700">
                                                Почта
                                            </label>
                                            <div class="mt-1">
                                                <input type="email" v-model="teacher.email" name="email" id="email" autocomplete="none" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Почта">
                                            </div>
                                        </div>


                                        <div class="mt-2">
                                            <label for="second_name" class="block text-sm font-medium text-gray-700">
                                                Фамилия
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" v-model="teacher.second_name" name="second_name" id="second_name" autocomplete="none" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Фамилия">
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                                Имя
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" v-model="teacher.first_name" name="first_name" id="first_name" autocomplete="none" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Имя">
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="middle_name" class="block text-sm font-medium text-gray-700">
                                                Отчество
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" v-model="teacher.middle_name" name="middle_name" id="middle_name" autocomplete="none" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Отчество">
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="password" class="block text-sm font-medium text-gray-700">
                                                Пароль
                                            </label>
                                            <div class="mt-1">
                                                <input type="password" v-model="teacher.password" name="password" id="password" autocomplete="none" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Пароль">
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                                Подтведите пароль
                                            </label>
                                            <div class="mt-1">
                                                <input type="password" v-model="teacher.password_confirmation" name="password_confirmation" autocomplete="none" id="password_confirmation" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Подтвердите пароль">
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="lesson" class="block text-sm font-medium text-gray-700">
                                                Предмет
                                            </label>
                                            <div class="mt-1">
                                                <select v-if="lessons" name="lesson[]"  id="lesson" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" multiple>
                                                    <option value="null" selected>Не выбрано</option>
                                                    <option v-bind:value="lesson.id" v-for="lesson in lessons">{{ lesson.name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="type" class="block text-sm font-medium text-gray-700">
                                                Должность
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" v-model="teacher.type" name="type" id="type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Должность">
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label for="classroom_teacher" class="block text-sm font-medium text-gray-700">
                                                Классный руководитель
                                            </label>
                                            <div class="mt-1" v-if="classes">
                                                <select type="text" name="classroom_teacher" id="classroom_teacher" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <option value="null" selected>Нет</option>
                                                    <option v-bind:value="cl.id" v-for="cl in classes">{{ cl.number }}{{ cl.letter }}</option>
                                                </select>
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

                    </form>
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
                errors: [],
                classes: null,
                lessons: null,
                teacher: {
                    formType: 1,
                    name: null,
                    email: null,
                    first_name: null,
                    second_name: null,
                    middle_name: null,
                    password: null,
                    password_confirmation: null,
                    lessons: null,
                    type: null,
                    class: null,
                },
            };
        },
        methods: {
            sendChanges: async function (e)
            {
                e.preventDefault();

                this.getChanges();

                await axios.post('/teacher/', this.teacher)
                    .then(response => {
                        this.$emit('updateParent');
                        this.closeModal()
                    })
                    .catch(e => {
                        this.error = e;
                    });
            },


            getChanges: function ()
            {
                this.teacher.class = document.getElementById('classroom_teacher').value;

                this.teacher.lessons = {};
                let i = 0;

                for (let option of document.getElementById('lesson').options)
                {
                    if (option.selected) {
                        i++;

                        this.teacher.lessons[i] = {'id': option.value};

                        // this.changedTeacher.lessons.push({'id': option.value});
                    }
                }

                this.teacher.lessons = JSON.stringify(this.teacher.lessons);

                this.validate();
            },

            closeModal: function ()
            {
                this.teacher = null;
                this.id = null;
                this.errors = null;
                this.teacher =  {
                    name: null,
                    first_name: null,
                    second_name: null,
                    middle_name: null,
                    lessons: null,
                    type: null,
                    class: null,
                };

                this.open = false;

            },

            getData: async function ()
            {
                if (!this.classes) {
                    await axios.get('/classes/get').then(response => {this.classes = response.data})
                }
                if (!this.lessons) {
                    await axios.get('/lesson/get').then(response => {this.lessons = response.data})
                }
            },

            validate: function () {
                if (this.teacher.password !== this.teacher.password_confirmation) {
                    this.errors.push('Пароли не совпадают');
                }
            }
        },
        mounted() {
            this.getData();
        }
    }


</script>
