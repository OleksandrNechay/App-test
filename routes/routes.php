<?php

global $app;

use App\Controllers\Site\HomeController;
use App\Controllers\Site\FilmController;
use App\Controllers\Auth\AuthController;
use App\Controllers\FileController;

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/films', [FilmController::class, 'index']);
$app->router->get('/film/{id}', [FilmController::class, 'show']);

$app->router->post('/film/create', [FilmController::class, 'create']);
$app->router->post('/film/delete/{id}', [FilmController::class, 'delete']);

$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->post('/logout', [AuthController::class, 'logout']);

$app->router->post('/upload', [FileController::class, 'handle']);