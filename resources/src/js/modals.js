document.addEventListener('DOMContentLoaded', function () {
    login();
    registration();
    createFilm();
    uploadFile();
    logout()
});

function login() {
    const loginButton = document.querySelector('.btn-outline-primary');
    if (!loginButton) return;
    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));

    loginButton.addEventListener('click', function () {
        loginModal.show();
    });

    // Optional: Handle form submission
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        send(loginModal, loginForm, '/login');
    });
}

function registration() {
    const signUpButton = document.querySelector('.registration');
    if (!signUpButton) return;
    const registrationModal = new bootstrap.Modal(document.getElementById('registrationModal'));
    signUpButton.addEventListener('click', function () {
        registrationModal.show();
    });

    // Handle form submission for registration
    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        send(registrationModal, registrationForm, '/register'); // Assuming '/register' is your registration endpoint
    });
}

function logout() {
    const logoutButton = document.getElementById('logoutButton');
    if(!logoutButton) return;

    logoutButton.addEventListener('click', function () {
        fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                // You can add any additional data here if needed
            }),
        }).then(response => {
            if (response.ok) {
                // Reload the page after successful logout
                location.reload();
            } else {
                console.error('Logout failed');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    });
}

function createFilm() {
    const addFilmButton = document.querySelector('.btn.btn-primary[data-bs-toggle="modal"]');
    if(!addFilmButton) return;
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

function uploadFile() {
    const uploadFileButton = document.getElementById('uploadFileButton');
    if(!uploadFileButton) return;
    const uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));

    uploadFileButton.addEventListener('click', function () {
        uploadModal.show();
    });

    const uploadForm = document.getElementById('uploadForm');
    uploadForm.addEventListener('submit', function (event) { // Add 'event' parameter here
        event.preventDefault(); // Prevent default form submission behavior
        send(uploadModal, uploadForm, '/upload');
    });

    const uploadButton = document.querySelector('.modal-footer .btn.btn-success');

    uploadButton.addEventListener('click', function () {
        // Trigger the form submission when the "Upload" button is clicked
        uploadForm.dispatchEvent(new Event('submit'));
    });
}

function send(modal, form, url) {
    fetch(url, {
        method: 'POST',
        body: new FormData(form)
    }).then(response => response.json())
        .then(data => {
            if (data.login === false) {
                const errorMessage = document.getElementById('errorMessage');
                errorMessage.textContent = data.message;
                return;
            } else if (data.register === false) {
                const errorMessage = document.getElementById('emailError');
                errorMessage.textContent = data.message;
                return;
            }else if (data.isCreated) {
                modal.hide();
                const exampleModal = new bootstrap.Modal(document.getElementById('successModal'));
                exampleModal.show();
                return;
            }
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}