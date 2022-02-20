let editModal = {
    modal:          document.getElementById('modal'),
    numberInput:    document.getElementById('number-input'),
    letterInput:    document.getElementById('letter-input'),
    passwordStr:    document.getElementById('password-str'),
    closeButton:    document.getElementById('close-button'),
    saveButton:     document.getElementById('save-button'),
    deleteButton:   document.getElementById('delete-button'),
    background:     document.querySelector('.opacity-class'),

}

let createModal = {
    modal: document.getElementById('create-modal'),
    modal_content: document.querySelector('.modal-content'),
    numberInput: document.getElementById('create-number-input'),
    letterInput: document.getElementById('create-letter-input'),
    closeButton: document.getElementById('create-close-button'),
    createButton: document.getElementById('create-button'),
    background: document.querySelector('.create-opacity-class'),
}

const classButtons = document.querySelectorAll('.class-button');
const createBtn = document.getElementById('create-btn');

let id, saveUrl, deleteUrl, createUrl, deleteUrlE, saveUrlE, password;
let error;

function openEditModal(e) {
    let button = e.target;
    let classNumber = button.dataset.number;
    let classLetter = button.dataset.letter;
    id = button.dataset.id;
    saveUrl = button.dataset.saveUrl;
    deleteUrl = button.dataset.deleteUrl;
    password = button.dataset.password

    editModal.numberInput.value = classNumber;
    editModal.letterInput.value = classLetter;
    // editModal.passwordStr.innerHTML = "Пароль: " + password;

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

    axios.delete(deleteUrl).then(response => {
        updatePageBeforeDelete();
    }).catch(e => {
        console.error(`Какая-то ошибка: ${e}`);
        error = e;
    });

}

function updatePageBeforeDelete() {
    let button = document.querySelector('.id-' + id);
    button.remove();

    closeEditModal();
}

function openCreateModal() {
    createUrl = createModal.modal.dataset.createUrl;
    createModal.modal.classList.remove('hidden');
}

function closeCreateModal() {
    createModal.modal_content.innerHTML = '';
    createModal.modal_content.insertAdjacentHTML('beforeend', `
        <form>
                    <div>
                        <div class="head flex justify-between mb-2">
                            <h2>Создать класс</h2>
                            <button type="button" id="create-close-button" class="close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="flex">
                            <input type="text" id="create-number-input" class="number w-3/12 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Цифра" required>
                            <input type="text" id="create-letter-input" class="letter w-3/12 ml-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Буква" required>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 flex justify-end">
                        <button type="submit" id="create-button" class="create w-5/12 inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                            Создать
                        </button>
                    </div>
                </form>
    `)

    document.getElementById('create-button').addEventListener('click', createClass);

    createModal.modal.classList.add('hidden');
}

function createClass(e) {
    e.preventDefault()

    let number = document.getElementById('create-number-input').value;
    let letter = document.getElementById('create-letter-input').value;

    if (!number || !letter ) {
        alert('Оба поля должны быть заполнены');
        return;
    }

    axios.post(createUrl, {'number': number, 'letter': letter}).then(response => {
        updatePageBeforeCreate(response.data.rId, number, letter, response.data.pass);
    }).catch(e => {
        console.error(`Какая-то ошибка: ${e}`);
        error = e;
    });
}

function updatePageBeforeCreate(rId, number, letter, password) {
    document.querySelector('.classes').insertAdjacentHTML('afterbegin', `
         <button type="button" class="class-button id-${ rId } text-blue-600 mr-4" data-id="${ rId }" data-number="${ number }" data-letter="${ letter }" data-save-url="${ saveUrlE }" data-delete-url="${ deleteUrlE + '/' + rId }" data-password="${ password }">
                   ${number + letter}
        </button>
    `);

    document.querySelector('.id-' + rId).addEventListener('click', openEditModal);

    createModal.modal_content.innerHTML = '';
    // createModal.modal_content.insertAdjacentHTML('beforeend', `
    //         <div>
    //             <div class="head flex justify-between mb-2">
    //                 <h1 class="text-2xl">Пароль для класса:</h1>
    //             </div>
    //             <div class="flex ml-4">
    //                 <h2 class="text-1xl">
    //                     ${password}
    //                 </h2>
    //             </div>
    //         </div>
    //         <div class="mt-5 sm:mt-6 flex justify-end">
    //             <button type="button" id="close-button-c" class="close w-5/12 inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
    //                 Выйти
    //             </button>
    //         </div>
    // `)

    closeCreateModal();

    // document.getElementById('close-button-c').addEventListener('click', closeCreateModal);
}

function init() {
    deleteUrlE = document.location.protocol + '//' + document.location.host + '/classes';
    saveUrlE = document.querySelector('.classes').dataset.saveUrl;

    classButtons.forEach(function (elem) {
        elem.addEventListener('click', openEditModal);
    })

    editModal.background.addEventListener('click', closeEditModal);
    editModal.closeButton.addEventListener('click', closeEditModal);

    editModal.saveButton.addEventListener('click', saveClass);
    editModal.deleteButton.addEventListener('click', deleteClass);

    createBtn.addEventListener('click', openCreateModal);
    createModal.closeButton.addEventListener('click', closeCreateModal);
    createModal.background.addEventListener('click', closeCreateModal);

    createModal.createButton.addEventListener('click', createClass);
}

init();

