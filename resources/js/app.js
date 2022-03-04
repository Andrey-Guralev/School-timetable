require('./bootstrap');
require('@fortawesome/fontawesome-free/js/fontawesome.min');

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


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
