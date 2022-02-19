let input = document.querySelectorAll('#class');

function updateClass(e) {
    let Class = e.target.value;
    let url = e.target.dataset.url;
    let id = e.target.dataset.userId;

    axios.post(url, {'class': Class, 'id': id}).then(response => {})
        .catch(e => {
            console.error(`Какая-то ошибка: ${e}`);
            error = e;
        });
}

function init() {
    input.forEach(function (value, key, parent) {
        value.addEventListener('change', updateClass);
    })
}

init();
