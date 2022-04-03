const closeButton = document.querySelector('#closeSideBar');
const openButton = document.querySelector('#openSideBar');


function openAdminNav(e) {
    const nav = document.getElementById('mobile-nav');

    nav.classList.remove('hidden');
}

function closeAdminNav(e) {
    const nav = document.getElementById('mobile-nav');

    nav.classList.add('hidden');
}

if (closeButton && openButton) {
    closeButton.addEventListener('click', closeAdminNav);
    openButton.addEventListener('click', openAdminNav);
}
