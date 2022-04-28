require('./bootstrap');
require('@fortawesome/fontawesome-free/js/fontawesome.min');

// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();


window.Vue = require('vue').default;

Vue.config.productionTip = false; //TODO: Убрать!!!!

function adminVueComponentsRequire() {
    Vue.component('announcements-create-component', require('../components/Admin/Announcements/AnnouncementsCreateFormComponent.vue').default);

    Vue.component('teacher-index', require('../components/Admin/Teacher/TeacherIndexComponent').default);
    Vue.component('teacher-edit-modal', require('../components/Admin/Teacher/TeacherEditModalComponent').default);
    Vue.component('teacher-create-modal', require('../components/Admin/Teacher/TeacherCreateModalComponent').default);
    Vue.component('teacher-create-modal', require('../components/Admin/Teacher/TeacherCreateModalComponent').default);

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
}

function studentsVueComponentsRequire() {
    Vue.component('student-timetable-index', require('../components/Student/Timetable/StudentTimetableIndex').default);
    Vue.component('student-timetable-table', require('../components/Student/Timetable/StudentTimetableTable').default);
}


studentsVueComponentsRequire();
adminVueComponentsRequire();

const app = new Vue({
    el: '#app',
});

if (window.location.pathname.indexOf('users') === 1) {
    require('./editUsers');
}

require('./adminNavbarHandler');
