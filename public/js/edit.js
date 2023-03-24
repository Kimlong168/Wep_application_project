
const exampleModal = document.getElementById('exampleModal');

exampleModal.addEventListener('show.bs.modal', event => {

    // Button that triggered the modal
    const button = event.relatedTarget;

    const href = button.getAttribute('data-bs-href');

    const btnYes = exampleModal.querySelector('.btn-ok');

    btnYes.href = href;

});