let editModal = {
    modal:          document.getElementById('modal'),
    numberInput:    document.getElementById('number-input'),
    letterInput:    document.getElementById('letter-input'),
    closeButton:    document.getElementById('close-button'),
    saveButton:     document.getElementById('save-button'),
    deleteButton:   document.getElementById('delete-button'),
    background:     document.querySelector('.opacity-class'),

}

let createModal = {
    modal: document.getElementById('create-modal'),
    numberInput: document.getElementById('create-number-input'),
    letterInput: document.getElementById('create-letter-input'),
    closeButton: document.getElementById('create-close-button'),
    createButton: document.getElementById('create-button'),
    background: document.querySelector('.create-opacity-class'),
}

const classButtons = document.querySelectorAll('.class-button');
const createButton = document.getElementById('create-btn');

let id, saveUrl, deleteUrl, createUrl, deleteUrlE, saveUrlE;
let error;

function openEditModal(e) {
    let button = e.target;
    let classNumber = button.dataset.number;
    let classLetter = button.dataset.letter;
    id = button.dataset.id;
    saveUrl = button.dataset.saveUrl;
    deleteUrl = button.dataset.deleteUrl

    editModal.numberInput.value = classNumber;
    editModal.letterInput.value = classLetter;

    editModal.modal.classList.remove('hidden');
}

function closeEditModal() {
    editModal.modal.classList.add('hidden');
}

function saveClass(e) {
    e.preventDefault();

    let number = editModal.numberInput.value;
    let letter = editModal.letterInput.value;

    if (!number || !letter) {
        alert('Оба поля должны быть заполнены');
        return;
    }


    axios.patch(saveUrl, {'id':  id,'number': number, 'letter': letter}).then(response => {
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

    closeEditModal();
}

function deleteClass() {
    if (!confirm('Точно удалить класс?')) {
        return;
    }

    console.log(deleteUrl)

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

    closeEditModal();
}

function openCreateModal() {
    createUrl = createModal.modal.dataset.createUrl;
    createModal.modal.classList.remove('hidden');
}

function closeCreateModal() {
    createModal.modal.classList.add('hidden');
}

function createClass(e) {
    e.preventDefault()

    let number = createModal.numberInput.value;
    let letter = createModal.letterInput.value;

    if (!number || !letter ) {
        alert('Оба поля должны быть заполнены');
        return;
    }

    axios.post(createUrl, {'number': number, 'letter': letter}).then(response => {
        updatePageBeforeCreate(response.data.rId, number, letter);
    }).catch(e => {
        console.error(`Какая-то ошибка: ${e}`);
        error = e;
    });
}

function updatePageBeforeCreate(rId, number, letter) {
    document.querySelector('.classes').insertAdjacentHTML('afterbegin', `
         <button type="button" class="class-button id-${ rId } text-blue-600 mr-4" data-id="${ rId }" data-number="${ number }" data-letter="${ letter }" data-save-url="${ saveUrlE }" data-delete-url="${ deleteUrlE + '/' + rId }">
                   ${number + letter}
        </button>
    `);

    document.querySelector('.id-' + rId).addEventListener('click', openEditModal);

    closeCreateModal();
}

function init() {
    deleteUrlE = document.location.protocol + '//' + document.location.host + '/classes';
    saveUrlE = document.querySelector('.classes').dataset.saveUrl;

    console.log(deleteUrlE)

    classButtons.forEach(function (elem) {
        elem.addEventListener('click', openEditModal);
    })

    editModal.background.addEventListener('click', closeEditModal);
    editModal.closeButton.addEventListener('click', closeEditModal);

    editModal.saveButton.addEventListener('click', saveClass);
    editModal.deleteButton.addEventListener('click', deleteClass);

    createButton.addEventListener('click', openCreateModal);
    createModal.closeButton.addEventListener('click', closeCreateModal);
    createModal.background.addEventListener('click', closeCreateModal);

    createModal.createButton.addEventListener('click', createClass);
}

init();

/* const editModal = document.getElementById('modal');
 const numberInput = document.getElementById('number-input');
 const letterInput = document.getElementById('letter-input');
 const closeButton = document.getElementById('close-button');
 const saveButton = document.getElementById('save-button');
 const deleteButton = document.getElementById('delete-button');
 const background = document.querySelector('.opacity-class'); */
// const createModal = document.getElementById('modal');
// const createNumberInput = document.getElementById('number-input');
// const createLetterInput = document.getElementById('letter-input');
// const createCloseButton = document.getElementById('close-button');
