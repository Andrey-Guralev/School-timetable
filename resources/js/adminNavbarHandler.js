const closeButton = document.querySelector('#closeSideBar');
const openButton = document.querySelector('#openSideBar');


function openAdminNav() {
    const nav = document.getElementById('mobile-nav');

    nav.classList.remove('hidden');
}

function closeAdminNav() {
    const nav = document.getElementById('mobile-nav');

    nav.classList.add('hidden');
}

function init() {
    if (closeButton && openButton) {
        closeButton.addEventListener('click', closeAdminNav);
        openButton.addEventListener('click', openAdminNav);
    }
}

init();
