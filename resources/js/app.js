require('./bootstrap');
require('@fortawesome/fontawesome-free/js/fontawesome.min')

if (window.location.pathname.indexOf('timetable/edit/') === 1) {
    require('./editForm');
}

if (window.location.pathname.indexOf('classes/edit') === 1) {
    require('./editClasses');
}

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
