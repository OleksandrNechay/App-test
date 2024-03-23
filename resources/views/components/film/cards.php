<?php foreach ($films as $film): ?>
    <div class="film card mb-3">
        <a href="/film/<?php echo $film['id']; ?>" class="card-link">
            <div class="card-body text-dark text-decoration-none">
                <h3 class="card-title"><?php echo htmlspecialchars($film['title']); ?></h3>
                <p class="card-text"><strong>Format:</strong> <?php echo htmlspecialchars($film['format']); ?></p>
                <p class="card-text"><strong>Release Date:</strong> <?php echo $film['release_date']; ?></p>
                <p class="card-text"><strong>Actors:</strong> <?php echo htmlspecialchars($film['actors']); ?></p>
            </div>
        </a>
        <?php if (\Core\Application::$app->isAuthorized()): ?>
            <div class="card-footer d-flex justify-content-end">
                <a href="#" class="btn btn-danger btn-sm delete-film"
                   data-film-id="<?php echo $film['id']; ?>">Delete</a>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>