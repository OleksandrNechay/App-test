document.addEventListener('DOMContentLoaded', function () {
    login();
    registration();
    createFilm();
});

function login() {
    const loginButton = document.querySelector('.btn-outline-primary'); // Adjust this selector based on your button class or ID
    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));

    loginButton.addEventListener('click', function () {
        loginModal.show();
    });

    // Optional: Handle form submission
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        send(loginForm, '/login');
    });
}

function registration(){
    const signUpButton = document.querySelector('.btn.btn-primary');
    signUpButton.addEventListener('click', function () {
        const registrationModal = new bootstrap.Modal(document.getElementById('registrationModal'));
        registrationModal.show();
    });

    // Handle form submission for registration
    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        send(registrationForm, '/register'); // Assuming '/register' is your registration endpoint
    });
}

function createFilm(){
    const addFilmButton = document.querySelector('.btn.btn-primary[data-bs-toggle="modal"]');
    const addFilmModal = new bootstrap.Modal(document.getElementById('addFilmModal'));

    addFilmButton.addEventListener('click', function () {
        addFilmModal.show();
    });

    const registrationForm = document.getElementById('addFilmForm');
    registrationForm.addEventListener('submit', function (event) {
        event.preventDefault();
        send(addFilmModal, registrationForm, '/film/create');
    });
}

function send(modal, form, url) {
    fetch(url, {
        method: 'POST',
        body: new FormData(form)
    }).then(response => response.json())
        .then(data => {
            modal.hide();
            if(data.isCreated){
                const exampleModal = new bootstrap.Modal(document.getElementById('successModal'));
                exampleModal.show();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}