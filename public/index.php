<?php

require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../settings.php';

$app = new \Core\Application();

$app->router->get('/', [\App\Controllers\Site\HomeController::class, 'index']);
$app->router->get('/films', [\App\Controllers\Site\FilmController::class, 'index']);
$app->router->get('/film/{id}', [\App\Controllers\Site\FilmController::class, 'show']);

$app->router->post('/film/create', [\App\Controllers\Site\FilmController::class, 'create']);
$app->router->post('/film/delete/{id}', [\App\Controllers\Site\FilmController::class, 'delete']);

$app->router->post('/login', [\App\Controllers\Auth\AuthController::class, 'login']);
$app->router->post('/register', [\App\Controllers\Auth\AuthController::class, 'register']);


$app->run();