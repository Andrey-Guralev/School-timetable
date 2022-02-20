
function tinyMceInit() {
    tinymce.init({
        selector: '#main-text',
        plugins: 'link lists',
        menubar: '',
        toolbar: 'undo redo | bold italic underline | link | alignleft aligncenter alignright alignjustify | outdent indent | forecolor backcolor removeformat ',
        height: 400,
        toolbar_mode: 'sliding',
        language: 'ru',
    });

}

function init() {
    tinyMceInit();
}

init();
