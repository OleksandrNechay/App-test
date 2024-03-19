document.addEventListener('DOMContentLoaded', function () {
    deleteFilm();
    onSubmitSearchEvent();
    insertSearchValue();
    sort();
});

function deleteFilm() {
    const deleteButtons = document.querySelectorAll('.delete-film');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const filmId = button.getAttribute('data-film-id');
            if (confirm('Are you sure you want to delete this film?')) {
                const filmId = button.getAttribute('data-film-id');
                const url = `/film/delete/${filmId}`; // Construct the delete URL

                fetch(url, {
                    method: 'POST',
                })
                    .then(response => {
                        if (response.ok) {
                            const deletedModal = new bootstrap.Modal(document.getElementById('deletedModal'));
                            deletedModal.show();
                        } else {
                            console.error('Failed to delete film');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });

    const refreshButton = document.getElementById('refreshButton');
    refreshButton.addEventListener('click', function () {
        location.reload();
    });
}

function onSubmitSearchEvent() {
    let form = document.querySelector('form#search-form')
    let action = location.pathname.split('/')[1]
    form.addEventListener('submit', event => {
        event.preventDefault()
        let input = form.querySelector('input[name="q"]')?.value
        let url = new URL(location.href)
        let q = url.searchParams.get('q')
        url = new URL(location.origin + '/' + action)
        if (q === input) return
        if (!input) {
            if (!q) return
            location.href = url.href
        } else {
            url.searchParams.set('q', input)
            location.href = url.href
        }
    })
}

function insertSearchValue() {
    // Get the search parameter value from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('q');

    // Set the search input value to the extracted search parameter value
    const searchInput = document.querySelector('#search-form input[name="q"]');
    if (searchInput && searchParam) {
        searchInput.value = searchParam;
    }
}

function sort() {
    const sortSelect = document.getElementById('sortSelect');

    sortSelect.addEventListener('change', function () {
        const selectedValue = sortSelect.value;
        if (selectedValue !== 'Choose...') {
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('sort', selectedValue);
            window.location.href = newUrl;
        }
    });
}