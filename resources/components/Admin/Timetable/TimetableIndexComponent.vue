<template>
    <div>
        <h2 class="font-bold text-3xl text-gray-800 leading-tight">
            Обновление расписания
        </h2>
        <div class="ml-8 mt-4">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="">
                    <div class="text-2xl text-bold">
                        Что обновить?
                    </div>
                    <div class="ml-4 mb-4">
                        <div class="">
                            <input v-model="settings.subjects" id="lessons" type="checkbox" name="lessons" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="lessons">
                                Предметы
                            </label>
                        </div>
                        <div class="">
                            <input v-model="settings.teachers" id="teachers" type="checkbox" name="teachers" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="teachers">
                                Учителя
                            </label>
                        </div>
                        <div class="">
                            <input v-model="settings.rooms" id="rooms" type="checkbox" name="rooms" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="rooms">
                                Кабинеты
                            </label>
                        </div>
                        <div class="">
                            <input v-model="settings.groups" id="groups" type="checkbox" name="groups" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="groups">
                                Группы
                            </label>
                        </div>
                        <div class="">
                            <input v-model="settings.classes" id="classes" type="checkbox" name="classes" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="classes">
                                Классы
                            </label>
                        </div>
                        <div class="">
                            <input v-model="settings.load" id="load" type="checkbox" name="load" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="load">
                                Нагрузка
                            </label>
                        </div>
                        <div class="">
                            <input v-model="settings.timetable" id="timetable" type="checkbox" name="timetable" checked class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="timetable">
                                Расписание
                            </label>
                        </div>
                    </div>
                </div>

                <input type="file" id="archive-input" name="xml" required v-on:change="getFile">

                <div class="flex items-baseline">
                    <button v-on:click="readFile" type="submit" data-url="" id="archive-send" class="flex mt-4 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Отправить
                    </button>
                    <span class="ml-4 " id="loading-message"></span>
                </div>
            </form>
        </div>
        <div class="explanation ml-8 mt-4 text-gray-600">* Необходимо импортироваить xml файл</div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            file: null,
            xml: null,
            settings: {
                subjects: true,
                teachers: true,
                rooms: true,
                groups: true,
                classes: true,
                load: true,
                timetable: true,
            },
        };
    },

    methods: {
        getFile: function (e) {
            this.file = null;

            this.file = e.target.files[0];
        },

        readFile: function (e) {
            e.preventDefault();

           if (this.file) {
               let reader = new FileReader();

               reader.readAsText(this.file, 'CP1251');

               reader.onerror = function () {
                   console.log('Ошибка чтения файла');
               }

               reader.addEventListener('load', function () {
                   this.xml = reader.result;
                   this.parseXml();
               }.bind(this), false)


           }

        },

        parseXml: function () {
            let parser = new DOMParser();
            let q = parser.parseFromString(this.xml, 'application/xml');

            // console.log(q.getElementsByTagName('card')[0].attributes[0].value);

            if(this.settings.subjects)
                this.parseSubjects(q.getElementsByTagName('subject'));
            if(this.settings.rooms)
                this.parseRooms(q.getElementsByTagName('classroom'));
            if(this.settings.classes)
                this.parseClasses(q.getElementsByTagName('class'));
            if(this.settings.groups)
                this.parseGroups(q.getElementsByTagName('group'));
            if(this.settings.teachers)
                this.parseTeachers(q.getElementsByTagName('teacher'));
            if(this.settings.load)
                this.parseLoad(q.getElementsByTagName('lesson'));
            if(this.settings.timetable)
                this.parseTimetable(q.getElementsByTagName('card'));
        },

        parseSubjects: function (subjects)
        {
            for (let i = 0; i < subjects.length; i++)
            {
                let subject = subjects[i];

                console.log(subject)
            }
        },

        parseRooms: function (rooms)
        {

        },

        parseClasses: function (classes)
        {

        },

        parseGroups: function (groups)
        {

        },

        parseTeachers: function (teachers)
        {

        },

        parseLoad: function (load)
        {

        },

        parseTimetable: function (timetable)
        {

        },
    },

    mounted() {

    }

}
</script>

<style scoped>

</style>
