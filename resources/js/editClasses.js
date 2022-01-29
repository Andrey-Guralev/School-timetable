const modal = document.getElementById('modal');
const numberInput = document.getElementById('number-input');
const letterInput = document.getElementById('letter-input');
const closeButton = document.getElementById('close-button');
const saveButton = document.getElementById('save-button');
const background = document.querySelector('.opacity-class');

const classButtons = document.querySelectorAll('.class-button');

let id, url;
let error;

function openModal(e) {
    let button = e.target;
    let classNumber = button.dataset.number;
    let classLetter = button.dataset.letter;
    id = button.dataset.id;
    url = button.dataset.url;

    numberInput.value = classNumber;
    letterInput.value = classLetter;

    modal.classList.remove('hidden');
}

function closeModal() {
    modal.classList.add('hidden');
}

function saveClass(e) {
    e.preventDefault();

    let number = numberInput.value;
    let letter = letterInput.value;

    axios.patch(url, {'id':  id,'number': number, 'letter': letter}).then(response => {
        // console.log(response.data);
        // location.reload();
        updatePage(number, letter);
    }).catch(e => {
        console.error(`Какая-то ошибка: ${e}`);
        error = e;
    });
}

function updatePage(number, letter) {
    let button = document.querySelector('.id-' + id);

    let str = String(number + letter);

    console.log(str)

    button.replaceWith(String(str));

    closeModal();
}

function init() {
    classButtons.forEach(function (elem) {
        elem.addEventListener('click', openModal);
    })

    background.addEventListener('click', closeModal);
    closeButton.addEventListener('click', closeModal);

    saveButton.addEventListener('click', saveClass);
}

init();
