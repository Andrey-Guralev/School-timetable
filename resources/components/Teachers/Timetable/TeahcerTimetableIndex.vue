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
import moment from "moment";

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

            this.allRingSchedule = (await axios.get('/ring/')).data

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
            this.$refs.timetableTable0.timetable = this.generateTimetableArray(q, 0);
            this.$refs.timetableTable0.ringSchedule = this.generateRingScheduleArray(0, 0)

            this.$refs.timetableTable1.timetable = this.generateTimetableArray(q, 1);
            this.$refs.timetableTable1.ringSchedule = this.generateRingScheduleArray(1, 0)

            this.$refs.timetableTable2.timetable = this.generateTimetableArray(q, 2);
            this.$refs.timetableTable2.ringSchedule = this.generateRingScheduleArray(2, 0);

            this.$refs.timetableTable3.timetable = this.generateTimetableArray(q, 3);
            this.$refs.timetableTable3.ringSchedule = this.generateRingScheduleArray(3, 0);

            this.$refs.timetableTable4.timetable = this.generateTimetableArray(q, 4);
            this.$refs.timetableTable4.ringSchedule = this.generateRingScheduleArray(4, 0);

            this.$refs.timetableTable5.timetable = this.generateTimetableArray(q, 5);
            this.$refs.timetableTable5.ringSchedule = this.generateRingScheduleArray(5, 0);

        },

        sendDataToSecondShiftClasses: function (q) {
            this.$refs.timetableTable6.timetable = this.generateTimetableArray(q, 0);
            this.$refs.timetableTable6.ringSchedule = this.generateRingScheduleArray(0, 1);

            this.$refs.timetableTable7.timetable = this.generateTimetableArray(q, 1);
            this.$refs.timetableTable7.ringSchedule = this.generateRingScheduleArray(1, 1);

            this.$refs.timetableTable8.timetable = this.generateTimetableArray(q, 2);
            this.$refs.timetableTable8.ringSchedule = this.generateRingScheduleArray(2, 1);

            this.$refs.timetableTable9.timetable = this.generateTimetableArray(q, 3);
            this.$refs.timetableTable9.ringSchedule = this.generateRingScheduleArray(3, 1);

            this.$refs.timetableTable10.timetable = this.generateTimetableArray(q, 4);
            this.$refs.timetableTable10.ringSchedule = this.generateRingScheduleArray(4, 1);

            this.$refs.timetableTable11.timetable = this.generateTimetableArray(q, 5);
            this.$refs.timetableTable11.ringSchedule = this.generateRingScheduleArray(5, 1);
        },

        generateTimetableArray(timetable, weekday) {
            let tt = [];

            timetable.forEach((v) => {
                if (v.weekday === weekday) {
                    tt.push(v);
                }
            })

            return tt;
        },

        generateRingScheduleArray: function (weekday, shift) {
            weekday = weekday + 1;

            let ringScheduleArray = [];

            this.allRingSchedule.ringScheduleEvents.forEach(function (value, index)
            {
                let a = moment(weekday, 'e');
                let b = moment(value.date);

                if(a.isSame(b, 'day'))
                {
                    if (shift === 0 && value.ring_schedule_type.shift === 1)
                    {
                        ringScheduleArray.push(value.ring_schedule_type.ring_schedule)
                    }
                    else if (shift === 1 && value.ring_schedule_type.shift === 2)
                    {
                        ringScheduleArray.push(value.ring_schedule_type.ring_schedule)
                    }
                }

            }.bind([this, ringScheduleArray, weekday, shift]));


            if(weekday === 6 && ringScheduleArray.length === 0)
            {
                let saturdayType = this.allRingSchedule.ringScheduleTypes.find(type => type.type === 'saturday' && type.shift === shift + 1);

                if (saturdayType) {
                    if (shift === 0 && saturdayType.shift === 1)
                    {
                        ringScheduleArray.push(saturdayType.ring_schedule)
                    } else if (shift === 1 && saturdayType.shift === 2)
                    {
                        ringScheduleArray.push(saturdayType.ring_schedule)
                    }
                }
            }

            if ( ringScheduleArray.length === 0) {

                let regularType = this.allRingSchedule.ringScheduleTypes.find(type => type.type === 'regular' && type.shift === shift + 1);

                console.log( regularType)

                if (regularType)
                {
                    if (shift + 1 === regularType.shift)
                    {
                        ringScheduleArray.push(regularType.ring_schedule)
                    }
                    else if (shift + 1 === regularType.shift)
                    {
                        console.log(1)
                        ringScheduleArray.push(regularType.ring_schedule)
                    }
                }
            }

            return ringScheduleArray;
        }

    },

    mounted() {
        this.getData();
    }
}
</script>

<style scoped lang="scss">

</style>
