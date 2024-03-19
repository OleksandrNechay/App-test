@header

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <h2 class="card-header text-center"><?php echo $film['title']; ?> - Film Details</h2>
                <div class="card-body">
                    <p><strong>Format:</strong> <?php echo $film['format']; ?></p>
                    <p><strong>Release Date:</strong> <?php echo $film['release_date']; ?></p>
                    <p><strong>Actors:</strong> <?php echo $film['actors']; ?></p>
<!--                    <p><strong>Description:</strong> --><?php //echo $film['description']; ?><!--</p>-->
                    <!-- Add more film details as needed -->
                </div>
            </div>
        </div>
    </div>
</main>

@footer