<template>
    <div class="my-2 inline-block w-full lg:w-1/2 lg:p-4 sm:p-0 sm:p-0">
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
                    <div class="flex justify-between">
                        <span class="lesson">{{ getLessons(number) }}</span>
                        <span class="rooms">{{ getRooms(number) }}</span>
                    </div>
                    <div class="ml-3 text-gray-600">
                        {{ getTeacher(number) }}
                    </div>
<!--&lt;!&ndash;                    Расписание звонков&ndash;&gt;-->
<!--                    <div class="ml-3 text-gray-600">-->
<!--                    </div>-->
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: [
        'weekday',
        'weekdayTitle'
    ],

    data() {
        return {
            updated: false,

            Class: null,
            lessons: null,
            timetable: null,
            rooms: null,
            teachers: null,
            load: null,

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

        getTeacher: function(number) {
            let i = this.timetable.filter(function (val) {
                return val.number === number;
            })

            let response = '';

            if (i.length === 1) {
                if (i[0].teacher.user) {
                    let p =  i[0].teacher.user;
                    response = p.second_name + ' ';
                    response += p.first_name + ' ';
                    response += p.middle_name;
                    return response;
                } else {
                    return  i[0].teacher.asc_teacher_name + ' ';
                }
            } else {
                i.forEach((val, key) => {
                    if (key === 0 ) {

                        if (val.teacher.user) {
                            let p = val.teacher.user;

                            response = p.second_name + ' ';
                            response += p.first_name + ' ';
                            response += p.middle_name;

                            response += ' / ';
                        } else {
                            response = val.teacher.asc_teacher_name + ' ';
                            response += ' / ';
                        }

                    } else {

                        if (val.teacher.user) {
                            let p = val.teacher.user;

                            response = p.second_name + ' ';
                            response += p.first_name + ' ';
                            response += p.middle_name;

                        } else {
                            response += val.teacher.asc_teacher_name + ' ';
                        }
                        // response += this.teachers.find(teacher => teacher.id === val.teacher_id);
                    }
                })

            }

            return response;
        }

        // getTeacher: function(number) {
        //     let i = this.timetable.filter(function (val) {
        //         return val.number === number;
        //     })
        //
        //     let response = '';
        //
        //     if (i.length === 1) {
        //         if (this.teachers.find(teahcer => teahcer.id === i[0].teacher_id).user) {
        //             let p =  this.teachers.find(teahcer => teahcer.id === i[0].teacher_id).user;
        //             response = p.second_name + ' ';
        //             response += p.first_name + ' ';
        //             response += p.middle_name;
        //             return response;
        //         } else {
        //             return  this.teachers.find(teahcer => teahcer.id === i[0].teacher_id).asc_teacher_name + ' ';
        //         }
        //     } else {
        //         i.forEach((val, key) => {
        //             if (key === 0 ) {
        //
        //                 if (this.teachers.find(teacher => teacher.id === val.teacher_id).user) {
        //                     let p = this.teachers.find(teacher => teacher.id === val.teacher_id).user;
        //
        //                     response = p.second_name + ' ';
        //                     response += p.first_name + ' ';
        //                     response += p.middle_name;
        //
        //                     response += ' / ';
        //                 } else {
        //                     response = this.teachers.find(teacher => teacher.id === val.teacher_id).asc_teacher_name + ' ';
        //                     response += ' / ';
        //                 }
        //
        //             } else {
        //
        //                 if (this.teachers.find(teacher => teacher.id === val.teacher_id).user) {
        //                     let p = this.teachers.find(teacher => teacher.id === val.teacher_id).user;
        //
        //                     response = p.second_name + ' ';
        //                     response += p.first_name + ' ';
        //                     response += p.middle_name;
        //
        //                 } else {
        //                     response += this.teachers.find(teacher => teacher.id === val.teacher_id).asc_teacher_name + ' ';
        //                 }
        //                 // response += this.teachers.find(teacher => teacher.id === val.teacher_id);
        //             }
        //         })
        //
        //     }
        //
        //     return response;
        // }
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
