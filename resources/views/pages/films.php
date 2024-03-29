@header

<main>
    <div class="container-fluid mt-4">
        <div class="row align-items-center mb-4">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                    <h2 class="mb-0">Films list</h2>
                    <div>
                        <label for="sortSelect" class="me-2">Sort by:</label>
                        <select class="form-select" id="sortSelect">
                            <option selected>Choose...</option>
                            <option value="order">Title</option>
                            <option value="older">From old to new</option>
                            <option value="new">From new to old</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (empty($films)): ?>
                    <div class="alert alert-warning" role="alert">
                        Nothing was found for your request.
                    </div>
                <?php else: ?>
                    <?php include __DIR__ . '/../components/film/cards.php'; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if (\Core\Application::$app->isAuthorized()): ?>
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addFilmModal">
                            Add Film
                        </button>
                        <button type="button" class="btn btn-success ms-2" id="uploadFileButton" data-bs-toggle="modal"
                                data-bs-target="#uploadModal">
                            Upload File
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>


@include('components/modals/film-create')
@include('components/modals/upload-file')
@include('components/modals/success')
@include('components/modals/deleted')

<style>
    .card-body a {
        color: inherit !important;
    }
</style>

<script type='text/javascript' src="/resources/src/js/films.js"></script>
@footer