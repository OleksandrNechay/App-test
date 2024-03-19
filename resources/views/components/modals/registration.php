<div class="modal" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Sign-up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your registration form here -->
                <form id="registrationForm">
                    <div class="mb-3">
                        <label for="registrationName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="registrationName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="registrationEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="registrationEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="registrationPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registrationPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
