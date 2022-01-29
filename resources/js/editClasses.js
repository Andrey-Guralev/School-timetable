const modal = document.getElementById('modal');
const numberInput = document.getElementById('number-input');
const letterInput = document.getElementById('letter-input');
const closeButton = document.getElementById('close-button');
const saveButton = document.getElementById('save-button');
const deleteButton = document.getElementById('delete-button');

const background = document.querySelector('.opacity-class');

const classButtons = document.querySelectorAll('.class-button');

let id, saveUrl, deleteUrl;
let error;

function openModal(e) {
    let button = e.target;
    let classNumber = button.dataset.number;
    let classLetter = button.dataset.letter;
    id = button.dataset.id;
    saveUrl = button.dataset.saveUrl;
    deleteUrl = button.dataset.deleteUrl;

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

    axios.patch(saveUrl, {'id':  id,'number': number, 'letter': letter}).then(response => {
        // console.log(response.data);
        // location.reload();
        updatePageBeforeSave(number, letter);
    }).catch(e => {
        console.error(`Какая-то ошибка: ${e}`);
        error = e;
    });
}

function updatePageBeforeSave(number, letter) {
    let button = document.querySelector('.id-' + id);

    button.removeAttribute('data-number');
    button.setAttribute('data-number', number);
    button.removeAttribute('data-letter');
    button.setAttribute('data-letter', letter);

    button.innerHTML = ''
    button.innerHTML = String(number + letter)

    closeModal();
}

function deleteClass() {
    if (!confirm('Точно удалить класс?')) {
        return;
    }

    axios.delete(deleteUrl).then(response => {
        updatePageBeforeDelete();
    }).catch(e => {
        console.error(`Какая-то ошибка: ${e}`);
        error = e;
    });

}

function updatePageBeforeDelete(number, letter) {
    let button = document.querySelector('.id-' + id);

    button.remove();

    closeModal();
}

function init() {
    classButtons.forEach(function (elem) {
        elem.addEventListener('click', openModal);
    })

    background.addEventListener('click', closeModal);
    closeButton.addEventListener('click', closeModal);

    saveButton.addEventListener('click', saveClass);
    deleteButton.addEventListener('click', deleteClass);

}

init();
