<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Choose File</label>
                        <input type="file" class="form-control-file" id="fileInput" name="file" required>
                    </div>
                    <div class="alert alert-danger" id="errorMessage" style="display: none;">
                        <span id="errorTitle">File processing error. Incorrect data in the file</span>
                        <ul id="errorList"></ul> <!-- Add error list for details -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="uploadButton">Upload</button>
            </div>
        </div>
    </div>
</div>
