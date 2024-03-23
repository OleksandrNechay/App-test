<div class="modal fade" id="addFilmModal" tabindex="-1" aria-labelledby="addFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFilmModalLabel">Add New Film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addFilmForm">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <div id="titleError" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="format" class="form-label">Format</label>
                        <select class="form-select" id="format" name="format" required>
                            <option value="DVD">DVD</option>
                            <option value="VHS">VHS</option>
                            <option value="Blue-Ray">Blue-Ray</option>
                            <option value="Digital">Digital</option>
                        </select>
                        <div id="formatError" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="releaseDate" class="form-label">Release Date</label>
                        <input type="number" class="form-control" id="release_date" name="release_date" min="1900" max="2024" required>
                        <div id="releaseDateError" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="actors" class="form-label">Actors</label>
                        <textarea class="form-control" id="actors" name="actors" rows="3" required></textarea>
                        <div id="actorsError" class="invalid-feedback"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>