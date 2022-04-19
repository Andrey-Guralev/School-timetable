<template>
    <div class="mx-auto">
        <student-timetable-table ref="timetableTable0" :weekdayTitle="weekdays[0]" weekday="0"></student-timetable-table>
        <student-timetable-table ref="timetableTable1" :weekdayTitle="weekdays[1]" weekday="1"></student-timetable-table>
        <student-timetable-table ref="timetableTable2" :weekdayTitle="weekdays[2]" weekday="2"></student-timetable-table>
        <student-timetable-table ref="timetableTable3" :weekdayTitle="weekdays[3]" weekday="3"></student-timetable-table>
        <student-timetable-table ref="timetableTable4" :weekdayTitle="weekdays[4]" weekday="4"></student-timetable-table>
        <student-timetable-table ref="timetableTable5" :weekdayTitle="weekdays[5]" weekday="5"></student-timetable-table>
    </div>
</template>

<script>
import StudentTimetableTable from "./StudentTimetableTable";

export default {

    components: {
        StudentTimetableTable
    },

    props: [
        'classId'
    ],

    data() {
        return {
            weekdays: ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],

            allTimetable: null,
            allLoad: null,
            allLessons: null,
            allRooms: null,
            allTeachers: null
        };
    },

    methods: {
        getData: async function () {
            this.allLoad = (await axios.get('/load/get/class/' + this.classId)).data;
            this.allLessons = (await axios.get('/lesson/get')).data;
            this.allTeachers = (await axios.get('/teacher/get')).data;
            this.allRooms = (await axios.get('room/get')).data;
            await axios.get('/timetable/' + this.classId).then((response) => {
                this.allTimetable = response.data;

                this.sendDataInTables(response.data)
            });
        },

        sendDataInTables: function (q) {
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
        }
    },

    mounted() {
        this.getData();
    }
}
</script>

<style scoped lang="scss">

</style>
