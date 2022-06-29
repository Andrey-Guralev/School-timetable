<template>
    <div class="my-2 inline-block w-full lg:w-1/2 p-4">
        <table class="min-w-full divide-y divide-gray-200 shadow border-b border-gray-300">
            <thead class="bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ weekdayTitle }}
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            <tr class="bg-white" v-for="number in m">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <div class="text-gray-600 text-sm">
                        {{ getRingSchedule(number) }}
                    </div>
                    <div class="flex justify-between">
                        <span class="lesson">{{ number }}. {{ getLessons(number) }}</span>
                        <span class="rooms">{{ getRooms(number) }}</span>
                    </div>
                    <div class="ml-3 text-gray-600">
                        {{  getClass(number) }}
                    </div>
<!--                   Расписание звонков-->
<!--                    <div class="ml-3 text-gray-600">-->
<!--                    </div>-->
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: [
        'weekday',
        'weekdayTitle'
    ],

    data() {
        return {
            updated: false,

            timetable: null,
            ringSchedule: [],

            max: null,
            m: [],
        };
    },

    methods: {
        ttHandle: function () {
            if (this.timetable != null) {
                this.timetable.sort((a, b) => {
                    return a.number - b.number
                })
            }

            let q = [];

            this.timetable.forEach((v, k) => {
                q.push(Number(v.number));
            })

            this.max = Math.max.apply(null, q);

            for (let i = 1; i <= this.max; i++) {
                this.m.push(i);
            }
        },

        getLessons: function (number) {

           let i = this.timetable.filter(function (val) {
                return val.number === number;
            })

            let response = '-';

            if (i.length === 1) {
                return i[0].lesson.name
                // return this.lessons.find(lesson => lesson.id === i[0].lesson_id).name;
            } else {
                i.forEach((val, key) => {
                    if (key === 0 ) {
                        response = val.lesson.name;
                        // response = this.lessons.find(lesson => lesson.id === val.lesson_id).name;
                        response += '/';
                    } else {
                        response += val.lesson.name;
                        // response += this.lessons.find(lesson => lesson.id === val.lesson_id).name;
                    }
                })

            }

            return response;
        },

        getRooms: function (number) {
            let i = this.timetable.filter(function (val) {
                return val.number === number;
            })

            let response = '';

            if (i.length === 1) {
                return i[0].rooms.room1.room;
                // return this.rooms.find(room => room.id === i[0].rooms.room1.room_id) != null ? this.rooms.find(room => room.id === i[0].rooms.room1.room_id).name : '';
            } else {
                i.forEach((val, key) => {
                    if (key === 0 ) {
                        response = val.rooms.room1.room
                        // response = this.rooms.find(room => room.id === val.rooms.room1.room_id) != null ? this.rooms.find(room => room.id === val.rooms.room1.room_id).name : '';
                        response += '/';
                    } else {
                        response += val.rooms.room1.room
                        // response += this.rooms.find(room => room.id === val.rooms.room1.room_id) != null ? this.rooms.find(room => room.id === val.rooms.room1.room_id).name : '';
                    }
                })

            }

            return response;
        },

        getClass: function (number) {
            let i = this.timetable.filter(function (val) {
                return val.number === number;
            })

            let response = '';

            if (i.length === 1) {
                response = 'В '
                response += i[0].class.number;
                response += i[0].class.letter;
            }

            return response;
        },

        getRingSchedule: function (number) {
            if (this.ringSchedule.length !== 0) {
                let rs = this.ringSchedule[0].find(rs => rs.number === number)
                return moment(rs.start_time, 'HH:mm:ss').format('HH:mm') + ' - ' + moment(rs.end_time, 'HH:mm:ss').format('HH:mm');
            }
        }
    },

    watch: {
        timetable: function () {
            if (this.updated === false) {
                this.ttHandle();

                this.updated = true

            }
        }
    },

    mounted() {

    }
}
</script>

<style scoped>

</style>
