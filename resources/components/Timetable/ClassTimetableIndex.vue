<template>
    <div class="flex flex-wrap ">
        <class-timetable-table ref="timetableTable0" :weekdayTitle="weekdays[0]" weekday="0"></class-timetable-table>
        <class-timetable-table ref="timetableTable1" :weekdayTitle="weekdays[1]" weekday="1"></class-timetable-table>
        <class-timetable-table ref="timetableTable2" :weekdayTitle="weekdays[2]" weekday="2"></class-timetable-table>
        <class-timetable-table ref="timetableTable3" :weekdayTitle="weekdays[3]" weekday="3"></class-timetable-table>
        <class-timetable-table ref="timetableTable4" :weekdayTitle="weekdays[4]" weekday="4"></class-timetable-table>
        <class-timetable-table ref="timetableTable5" :weekdayTitle="weekdays[5]" weekday="5"></class-timetable-table>
    </div>
</template>

<script>

import moment from "moment";
import ClassTimetableTable from "./ClassTimetableTable";

export default {

    components: {
        ClassTimetableTable
    },

    props: [
        'classId'
    ],

    data() {
        return {
            weekdays: ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],

            allTimetable: null,
            allRingSchedule: null,
            cl: null
        };
    },

    methods: {
        getData: async function () {
            this.allRingSchedule = (await axios.get('/ring')).data
            this.cl = (await axios.get('/classes/get/' + this.classId)).data
            await axios.get('/timetable/' + this.classId).then((response) => {
                this.allTimetable = response.data;

                this.sendDataInTables(response.data)
            });


        },

        sendDataInTables: function (q) {

            let date = new moment;
            let weekday = date.format('e');


            this.$refs.timetableTable0.timetable = this.generateTimetableArray(q, 0)
            this.$refs.timetableTable0.ringSchedule = this.generateRingScheduleArray(0)

            this.$refs.timetableTable1.timetable = this.generateTimetableArray(q, 1)
            this.$refs.timetableTable1.ringSchedule = this.generateRingScheduleArray(1)

            this.$refs.timetableTable2.timetable = this.generateTimetableArray(q,2)
            this.$refs.timetableTable2.ringSchedule = this.generateRingScheduleArray(2)

            this.$refs.timetableTable3.timetable = this.generateTimetableArray(q, 3)
            this.$refs.timetableTable3.ringSchedule = this.generateRingScheduleArray(3)

            this.$refs.timetableTable4.timetable = this.generateTimetableArray(q, 4);
            this.$refs.timetableTable4.ringSchedule = this.generateRingScheduleArray(4)

            this.$refs.timetableTable5.timetable = this.generateTimetableArray(q, 5);
            this.$refs.timetableTable5.ringSchedule = this.generateRingScheduleArray(5)

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

        generateRingScheduleArray: function (weekday) {
            weekday = weekday + 1;
            let z = [];
            this.allRingSchedule.ringScheduleEvents.forEach(function (value, index)
            {
                let a = moment(weekday, 'e');
                let b = moment(value.date);

                if(a.isSame(b, 'day'))
                {
                    if (this.cl.shift === 0 && value.ring_schedule_type.shift === 1)
                    {
                        z.push(value.ring_schedule_type.ring_schedule)
                    }
                    else if (this.cl.shift === 1 && value.ring_schedule_type.shift === 2)
                    {
                        z.push(value.ring_schedule_type.ring_schedule)
                    }
                }

            }.bind(this).bind(z).bind(weekday));

            if(weekday === 6 && z.length === 0) {
                let saturdayType = this.allRingSchedule.ringScheduleTypes.find(type => type.type === 'saturday' && type.shift === this.cl.shift + 1);

                if (saturdayType) {
                    if (this.cl.shift === 0 && saturdayType.shift === 1) {
                        z.push(saturdayType.ring_schedule)
                    } else if (this.cl.shift === 1 && saturdayType.shift === 2) {
                        z.push(saturdayType.ring_schedule)
                    }
                }
            }

            if (weekday !== 6 && z.length === 0) {
                let regularType = this.allRingSchedule.ringScheduleTypes.find(type => type.type === 'regular' && type.shift === this.cl.shift + 1);

                if (regularType) {
                    if (this.cl.shift === 0 && regularType.shift === 1) {
                        z.push(regularType.ring_schedule)
                    } else if (this.cl.shift === 1 && regularType.shift === 2) {
                        z.push(regularType.ring_schedule)
                    }
                }
            }

            return z;
        }
    },

    mounted() {
        this.getData();
    }
}
</script>

<style scoped lang="scss">

</style>
