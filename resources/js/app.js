require('./bootstrap');
require('@fortawesome/fontawesome-free/js/fontawesome.min');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


window.Vue = require('vue').default;


// const files = require.context('./../', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('announcements-create-component', require('../components/Announcements/AnnouncementsCreateFormComponent.vue').default);
Vue.component('teacher-index', require('../components/Teacher/TeacherIndexComponent').default);
Vue.component('teacher-edit-modal', require('../components/Teacher/TeacherEditModalComponent').default);
Vue.component('teacher-create-modal', require('../components/Teacher/TeacherCreateModalComponent').default);


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
