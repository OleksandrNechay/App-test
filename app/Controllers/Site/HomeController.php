<?php

namespace App\Controllers\Site;

use App\Repositories\FilmRepository;
use App\Repositories\UserRepository;
use Core\View;

class HomeController
{
    protected View $view;
    protected UserRepository $userRepository;
    protected FilmRepository $filmRepository;

    public function __construct()
    {
        $this->view = new View();
//        $this->userRepository = new UserRepository();
//        $this->filmRepository = new FilmRepository();
    }

    public function index() : View
    {
        return $this->view->render('home');
    }
}