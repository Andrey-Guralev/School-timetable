require('./bootstrap');
require('@fortawesome/fontawesome-free/js/fontawesome.min');
let moment = require('moment/moment');

// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();

// import Calendar from 'v-calendar/lib/components/calendar.umd'
// import DatePicker from 'v-calendar/lib/components/date-picker.umd'

window.Vue = require('vue').default;

Vue.config.productionTip = false; //TODO: Убрать!!!!

function adminVueComponentsRequire() {
    Vue.component('announcements-create-component', require('../components/Admin/Announcements/AnnouncementsCreateFormComponent.vue').default);

    Vue.component('teacher-index', require('../components/Admin/Teacher/TeacherIndexComponent').default);
    Vue.component('teacher-create-modal', require('../components/Admin/Teacher/TeacherCreateModalComponent').default);
    Vue.component('teacher-edit-modal', require('../components/Admin/Teacher/TeacherEditModalComponent').default);


    Vue.component('load-index', require('../components/Admin/Load/LoadIndex').default);
    Vue.component('load-create-modal', require('../components/Admin/Load/LoadCreateModalComponent').default);
    Vue.component('load-edit-modal', require('../components/Admin/Load/LoadEditModalComponent').default);

    Vue.component('room-index', require('../components/Admin/Room/RoomIndex').default);
    Vue.component('room-create-modal', require('../components/Admin/Room/RoomCreateModalComponent').default);
    Vue.component('room-edit-modal', require('../components/Admin/Room/RoomEditModalComponent').default);

    Vue.component('lesson-index', require('../components/Admin/Lessons/LessonsIndex').default);
    Vue.component('lesson-create-modal', require('../components/Admin/Lessons/LessonCreateModalComponent').default);
    Vue.component('lesson-edit-modal', require('../components/Admin/Lessons/LessonEditModalComponent').default);

    Vue.component('classes-index', require('../components/Admin/Classes/ClassesIndex').default);
    Vue.component('edit-classes-component', require('../components/Admin/Classes/EditClassesModal').default);
    Vue.component('create-classes-component', require('../components/Admin/Classes/CreateClassesModal').default);

    Vue.component('timetable-index-component', require('../components/Admin/Timetable/TimetableIndexComponent').default);

    Vue.component('ring-schedule-index', require('../components/Admin/RingSchedule/RingScheduleIndex').default);
    Vue.component('ring-schedule-select-modal', require('../components/Admin/RingSchedule/RingScheduleSelectModal').default);
    Vue.component('ring-schedule-edit-modal', require('../components/Admin/RingSchedule/RingScheduleEditModal').default);
    Vue.component('ring-schedule-create-modal', require('../components/Admin/RingSchedule/RingScheduleCreateModal').default);
    Vue.component('ring-schedule-events-modal', require('../components/Admin/RingSchedule/RingScheduleEventsModal').default);
    Vue.component('ring-schedule-events-create-modal', require('../components/Admin/RingSchedule/RingScheduleEventsCreateModal').default);
    Vue.component('ring-schedule-events-edit-modal', require('../components/Admin/RingSchedule/RingScheduleEventsEditModal').default);


    Vue.component('v-calendar', require('v-calendar/lib/components/calendar.umd'));
    Vue.component('v-date-picker', require('v-calendar/lib/components/date-picker.umd'));
}

function studentsVueComponentsRequire() {
    Vue.component('student-timetable-index', require('../components/Student/Timetable/StudentTimetableIndex').default);
    Vue.component('student-timetable-table', require('../components/Student/Timetable/StudentTimetableTable').default);
}

function teacherVueComponentsRequire() {
    Vue.component('teacher-timetable-index', require('../components/Teachers/Timetable/TeahcerTimetableIndex').default);
    Vue.component('teacher-timetable-table', require('../components/Teachers/Timetable/TeacherTimetableTable').default);
}

function classVueComponentRequire () {
    Vue.component('class-timetable-index', require('../components/Timetable/ClassTimetableIndex').default);
    Vue.component('class-timetable-table', require('../components/Timetable/ClassTimetableTable').default);
}

teacherVueComponentsRequire();
studentsVueComponentsRequire();
adminVueComponentsRequire();
classVueComponentRequire();

const app = new Vue({
    el: '#app',
});

if (window.location.pathname.indexOf('users') === 1) {
    require('./editUsers');
}

require('./adminNavbarHandler');
