<?php

namespace App\Controllers\Site;

use App\Repositories\FilmRepository;
use App\Repositories\UserRepository;
use Core\Viewer;

class HomeController
{
    protected Viewer $viewer;
    protected UserRepository $userRepository;
    protected FilmRepository $filmRepository;

    public function __construct()
    {
        $this->viewer = new Viewer();
        $this->userRepository = new UserRepository();
        $this->filmRepository = new FilmRepository();
    }

    public function index()
    {
        return $this->viewer->renderView('home');
    }
}