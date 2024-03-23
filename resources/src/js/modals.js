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
        send(registrationModal, registrationForm, '/register');
    });
}

function logout() {
    const logoutButton = document.getElementById('logoutButton');
    if (!logoutButton) return;

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
    if (!addFilmButton) return;
    const addFilmModal = new bootstrap.Modal(document.getElementById('addFilmModal'));

    addFilmButton.addEventListener('click', function () {
        addFilmModal.show();
    });

    const addFilmForm = document.getElementById('addFilmForm');
    addFilmForm.addEventListener('submit', function (event) {
        event.preventDefault();
        let form = new FormData(addFilmForm)

        let data = {
            'title': form.get('title'),
            'format': form.get('format'),
            'releaseDate': form.get('release_date'),
            'actors': form.get('actors')
        }

        let isValid = validate(data)
        if (!isValid) return;

        send(addFilmModal, addFilmForm, '/film/create');
    });
}

function uploadFile() {
    const uploadFileButton = document.getElementById('uploadFileButton');
    if (!uploadFileButton) return;
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
        uploadForm.dispatchEvent(new Event('submit'));
    });
}

function send(modal, form, url) {
    fetch(url, {
        method: 'POST',
        body: new FormData(form)
    }).then(response => response.json())
        .then(data => {
            if (data.exception) {
                const errorMessage = document.getElementById('errorMessage');
                errorMessage.textContent = data.message;
                errorMessage.style.display = 'block';

                return;
            } else if (data.login === false) {
                const errorMessage = document.getElementById('errorMessage');
                errorMessage.textContent = data.message;
                return;
            } else if (data.register === false) {
                const errorMessage = document.getElementById('emailError');
                errorMessage.textContent = data.message;
                return;
            } else if (data.success) {
                modal.hide(); // Assuming you have a 'modal' variable that refers to the upload modal
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                const successMessage = document.getElementById('successMessage');
                successMessage.textContent = data.message; // Insert the message from the controller
                successModal.show();
                return;
            }
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function validate(data) {
    let errors = {};

    const rules = {
        'title': {required: true, maxLength: 255},
        'format': {required: true, maxLength: 50},
        'releaseDate': {required: true, min: 1900, max: new Date().getFullYear()},
        'actors': {required: true, maxLength: 65535, pattern: /^[A-Za-z,' \-\']+$/}
    };

    // Check each field against the rules
    Object.keys(rules).forEach(key => {
        const fieldRules = rules[key];
        const value = data[key].trim();

        if (fieldRules.required && value === '') {
            errors[key] = `${capitalize(key)} is required`;
        }

        if (fieldRules.maxLength && value.length > fieldRules.maxLength) {
            errors[key] = `${capitalize(key)} cannot exceed ${fieldRules.maxLength} characters`;
        }

        if (fieldRules.min && Number(value) < fieldRules.min) {
            errors[key] = `${capitalize(key)} must be at least ${fieldRules.min}`;
        }

        if (fieldRules.max && Number(value) > fieldRules.max) {
            errors[key] = `${capitalize(key)} must not exceed ${fieldRules.max}`;
        }

        if (fieldRules.pattern && !fieldRules.pattern.test(value)) {
            errors[key] = `${capitalize(key)} should only contain letters, hyphens, commas, and single quotes`;
        }
    });

    displayErrors(errors);
    return Object.keys(errors).length === 0;
}

function displayErrors(errors) {
    clearErrors();

    Object.keys(errors).forEach(key => {
        const errorElement = document.getElementById(key + 'Error');
        if (errorElement) {
            errorElement.textContent = errors[key];
            errorElement.style.display = 'block'; // Set display to block to make error visible
        }
    });
}

function clearErrors() {
    document.querySelectorAll('.invalid-feedback').forEach(errorElement => {
        errorElement.textContent = '';
        errorElement.style.display = 'none';
    });
}

function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
