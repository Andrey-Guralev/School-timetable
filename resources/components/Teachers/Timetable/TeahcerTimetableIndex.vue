<template>
    <div>
        <div class="text-xl">
            1-я смена
        </div>
        <div class="flex flex-wrap">
            <teacher-timetable-table ref="timetableTable0" :weekdayTitle="weekdays[0]" weekday="0" shift="0"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable1" :weekdayTitle="weekdays[1]" weekday="1" shift="0"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable2" :weekdayTitle="weekdays[2]" weekday="2" shift="0"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable3" :weekdayTitle="weekdays[3]" weekday="3" shift="0"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable4" :weekdayTitle="weekdays[4]" weekday="4" shift="0"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable5" :weekdayTitle="weekdays[5]" weekday="5" shift="0"></teacher-timetable-table>
        </div>
        <div class="text-xl">
            2-я смена
        </div>
        <div class="flex flex-wrap">
            <teacher-timetable-table ref="timetableTable6" :weekdayTitle="weekdays[0]" weekday="0" shift="1"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable7" :weekdayTitle="weekdays[1]" weekday="1" shift="1"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable8" :weekdayTitle="weekdays[2]" weekday="2" shift="1"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable9" :weekdayTitle="weekdays[3]" weekday="3" shift="1"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable10" :weekdayTitle="weekdays[4]" weekday="4" shift="1"></teacher-timetable-table>
            <teacher-timetable-table ref="timetableTable11" :weekdayTitle="weekdays[5]" weekday="5" shift="1"></teacher-timetable-table>
        </div>
    </div>
</template>

<script>
import TeacherTimetableTable from "./TeacherTimetableTable";

export default {

    components: {
        TeacherTimetableTable
    },

    props: [
        'teacherId'
    ],

    data() {
        return {
            weekdays: ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],

            allTimetable: null,
            allLoad: null,
            allClasses: null,
            allLessons: null,
            allRooms: null,
            allTeachers: null
        };
    },

    methods: {
        getData: async function () {

            // this.allClasses = (await axios.get('/classes/get')).data
            // this.allLoad = (await axios.get('/load/get/teacher/' + this.teacherId)).data;
            // this.allLessons = (await axios.get('/lesson/get')).data;
            // this.allTeachers = (await axios.get('/teacher/get')).data;
            // this.allRooms = (await axios.get('room/get')).data;
            await axios.get('/timetable/teacher/' + this.teacherId).then((response) => {
                this.allTimetable = response.data;

                this.sendDataInTables(response.data)
            });
        },

        sendDataInTables: function (allTimetable) {
            let timetableForFirstShift = [];
            let timetableForSecondShift = [];

            allTimetable.forEach((v) => {
                if (v.class.shift === 0) {
                    timetableForFirstShift.push(v);
                } else if (v.class.shift === 1) {
                    timetableForSecondShift.push(v);
                }

            })

            this.sendDataToFirstShiftClasses(timetableForFirstShift);
            this.sendDataToSecondShiftClasses(timetableForSecondShift);

        },

        sendDataToFirstShiftClasses: function (q) {
            let tt = [];

            q.forEach((v) => {
                if (v.weekday === 0) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable0.timetable = tt;
            this.$refs.timetableTable0.lessons = this.allLessons;
            this.$refs.timetableTable0.rooms = this.allRooms;
            this.$refs.timetableTable0.teachers = this.allTeachers;
            this.$refs.timetableTable0.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 1) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable1.timetable = tt;
            this.$refs.timetableTable1.lessons = this.allLessons;
            this.$refs.timetableTable1.rooms = this.allRooms;
            this.$refs.timetableTable1.teachers = this.allTeachers;
            this.$refs.timetableTable1.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 2) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable2.timetable = tt;
            this.$refs.timetableTable2.lessons = this.allLessons;
            this.$refs.timetableTable2.rooms = this.allRooms;
            this.$refs.timetableTable2.teachers = this.allTeachers;
            this.$refs.timetableTable2.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 3) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable3.timetable = tt;
            this.$refs.timetableTable3.lessons = this.allLessons;
            this.$refs.timetableTable3.rooms = this.allRooms;
            this.$refs.timetableTable3.teachers = this.allTeachers;
            this.$refs.timetableTable3.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 4) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable4.timetable = tt;
            this.$refs.timetableTable4.lessons = this.allLessons;
            this.$refs.timetableTable4.rooms = this.allRooms;
            this.$refs.timetableTable4.teachers = this.allTeachers;
            this.$refs.timetableTable4.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 5) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable5.timetable = tt;
            this.$refs.timetableTable5.lessons = this.allLessons;
            this.$refs.timetableTable5.rooms = this.allRooms;
            this.$refs.timetableTable5.teachers = this.allTeachers;
            this.$refs.timetableTable5.load = this.allLoad;
        },

        sendDataToSecondShiftClasses: function (q) {
            let tt = [];

            q.forEach((v) => {
                if (v.weekday === 0) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable6.timetable = tt;
            this.$refs.timetableTable6.lessons = this.allLessons;
            this.$refs.timetableTable6.rooms = this.allRooms;
            this.$refs.timetableTable6.teachers = this.allTeachers;
            this.$refs.timetableTable6.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 1) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable7.timetable = tt;
            this.$refs.timetableTable7.lessons = this.allLessons;
            this.$refs.timetableTable7.rooms = this.allRooms;
            this.$refs.timetableTable7.teachers = this.allTeachers;
            this.$refs.timetableTable7.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 2) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable8.timetable = tt;
            this.$refs.timetableTable8.lessons = this.allLessons;
            this.$refs.timetableTable8.rooms = this.allRooms;
            this.$refs.timetableTable8.teachers = this.allTeachers;
            this.$refs.timetableTable8.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 3) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable9.timetable = tt;
            this.$refs.timetableTable9.lessons = this.allLessons;
            this.$refs.timetableTable9.rooms = this.allRooms;
            this.$refs.timetableTable9.teachers = this.allTeachers;
            this.$refs.timetableTable9.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 4) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable10.timetable = tt;
            this.$refs.timetableTable10.lessons = this.allLessons;
            this.$refs.timetableTable10.rooms = this.allRooms;
            this.$refs.timetableTable10.teachers = this.allTeachers;
            this.$refs.timetableTable10.load = this.allLoad;

            tt = [];

            q.forEach((v) => {
                if (v.weekday === 5) {
                    tt.push(v);
                }
            })

            this.$refs.timetableTable11.timetable = tt;
            this.$refs.timetableTable11.lessons = this.allLessons;
            this.$refs.timetableTable11.rooms = this.allRooms;
            this.$refs.timetableTable11.teachers = this.allTeachers;
            this.$refs.timetableTable11.load = this.allLoad;
        }

    },

    mounted() {
        this.getData();
    }
}
</script>

<style scoped lang="scss">

</style>
