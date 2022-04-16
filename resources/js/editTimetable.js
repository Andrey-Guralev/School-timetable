// const sendButton = document.getElementById('archive-send');
// const archiveInput = document.getElementById('archive-input');
// const loadingMessage = document.getElementById('loading-message');
// const errorMessage = document.getElementById('error-message');
//
// function send(e) {
//     e.preventDefault();
//
//     if (archiveInput.files.length === 0) {
//         error('Вы не выбрали файл');
//         return;
//     }
//
//     if (archiveInput.files.length > 1) {
//         error('Нужно только один архив');
//         return;
//     }
//
//     if (archiveInput.files[0].type !== 'application/x-zip-compressed') {
//         error('Неправильный формат файла');
//         return;
//     }
//
//
//     let url = sendButton.dataset.url;
//     let formData = new FormData();
//
//     formData.append("archive", archiveInput.files[0])
//
//     axios.post(url, formData, {
//         headers: {
//             'Content-Type': 'multipart/form-data'
//         },
//         onUploadProgress: loading
//     })
//         .then(response => {
//             console.log(response.data)
//             loadingFinish(response.data);
//         })
//         .catch(e => {
//             console.error(`Какая-то ошибка: ${e}`);
//             error();
//     });
//
// }
//
// function error(string = null) {
//
//     if (string != null) {
//         loadingMessage.innerHTML = 'Ошибка: ' + string;
//
//         return;
//     }
//
//     loadingMessage.innerHTML = 'Ошибка, попробуйте еще'
// }
//
// function loading() {
//     // console.log('Загрузка')
//     loadingMessage.innerHTML = 'Загрузка...'
// }
//
// function loadingFinish(classes = null) {
//     // console.log('Загруженно')
//     loadingMessage.innerHTML = 'Расписание загруженно';
//
//     if (classes) {
//         errorMessage.innerHTML = 'Не удалось обновить расписание у классов: ' + classes;
//     }
// }
//
//
// function init() {
//     sendButton.addEventListener('click', send);
// }
//
// init();
