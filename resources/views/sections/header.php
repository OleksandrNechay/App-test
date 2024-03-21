<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <svg width="40" height="32" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
            <path d="M1.5 3a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-12a.5.5 0 0 1-.5-.5v-7zM0 3.5A1.5 1.5 0 0 1 1.5 2h12A1.5 1.5 0 0 1 15 3.5v7a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 0 10.5v-7z"/>
            <path d="M9 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
        </svg>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/films">Films</a>
            </li>
        </ul>
        <form id="search-form" class="form-inline my-2 my-lg-0 mr-2">
            <input class="form-control mr-sm-2" type="search" placeholder="Search..." aria-label="Search" name="q">
        </form>
        <?php if (!\Core\Application::$app->isAuthorized()): ?>
        <button class="btn btn-outline-primary mr-2" type="button">Login</button>
        <button class="btn btn-primary registration" type="button">Sign-up</button>
        <?php endif; ?>

        <?php if (\Core\Application::$app->isAuthorized()): ?>
            <form id="logoutForm" method="POST">
                <button id="logoutButton" class="btn btn-outline-danger" type="button">Logout</button>
            </form>
        <?php endif; ?>
    </div>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

