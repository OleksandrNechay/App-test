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
                    </div>
                    <div class="mb-3">
                        <label for="format" class="form-label">Format</label>
                        <input type="text" class="form-control" id="format" name="format" required>
                    </div>
                    <div class="mb-3">
                        <label for="releaseDate" class="form-label">Release Date</label>
                        <input type="date" class="form-control" id="release_date" name="release_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="actors" class="form-label">Actors</label>
                        <textarea class="form-control" id="actors" name="actors" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> Create </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>