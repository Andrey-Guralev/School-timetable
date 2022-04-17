require('./bootstrap');
require('@fortawesome/fontawesome-free/js/fontawesome.min');

// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();


window.Vue = require('vue').default;

Vue.component('announcements-create-component', require('../components/Announcements/AnnouncementsCreateFormComponent.vue').default);

Vue.component('teacher-index', require('../components/Teacher/TeacherIndexComponent').default);
Vue.component('teacher-edit-modal', require('../components/Teacher/TeacherEditModalComponent').default);
Vue.component('teacher-create-modal', require('../components/Teacher/TeacherCreateModalComponent').default);
Vue.component('teacher-create-modal', require('../components/Teacher/TeacherCreateModalComponent').default);

Vue.component('load-index', require('../components/Load/LoadIndex').default);
Vue.component('load-create-modal', require('../components/Load/LoadCreateModalComponent').default);
Vue.component('load-edit-modal', require('../components/Load/LoadEditModalComponent').default);

Vue.component('lesson-index', require('../components/Lessons/LessonsIndex').default);
Vue.component('lesson-create-modal', require('../components/Lessons/LessonCreateModalComponent').default);
Vue.component('lesson-edit-modal', require('../components/Lessons/LessonEditModalComponent').default);

Vue.component('classes-index', require('../components/Classes/ClassesIndex').default);
Vue.component('edit-classes-component', require('../components/Classes/EditClassesModal').default);
Vue.component('create-classes-component', require('../components/Classes/CreateClassesModal').default);

const app = new Vue({
    el: '#app',
});


if (window.location.pathname.indexOf('timetable/edit/') === 1) {
    require('./editForm');
}

if (window.location.pathname.indexOf('classes/edit') === 1) {
    require('./editClasses');
}

if (window.location.pathname.indexOf('announcements/create') === 1 || window.location.pathname.indexOf('announcements/edit') === 1) {
    require('./formAnnouncements');
}

if (window.location.pathname.indexOf('users') === 1) {
    require('./editUsers');
}

if (window.location.pathname.indexOf('timetable/edit') === 1) {
    require('./editTimetable');
}


require('./adminNavbarHandler');
