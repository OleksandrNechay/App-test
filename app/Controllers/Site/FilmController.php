<?php

namespace App\Controllers\Site;

use App\Filters\Film\FilmFilterDTO;
use App\Repositories\FilmRepository;
use Core\Request;
use Core\Response;
use Core\View;

class FilmController
{
    protected View $view;
    protected FilmRepository $filmRepository;

    public function __construct()
    {
        $this->view = new View();
        $this->filmRepository = new FilmRepository();
    }

    public function index(Request $request): View
    {
        $inputs = FilmFilterDTO::make($request);

        $films = $this->filmRepository->filter($inputs)->get();

        return $this->view->render('films', [
            'films' => $films,
            'search' => $inputs->search
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->getData();

        $this->filmRepository->create($data);

        $responseHandler = new Response();
        return $responseHandler->json(['success' => true, 'message' => 'Film created successfully.']);
    }

    public function show(Request $request): View
    {
        $id = $request->getOption('id');

        $film = $this->filmRepository->findBy('id', $id);

        if (!$film) return $this->view->notFound();

        return $this->view->render('film', [
            'film' => $film
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->getOption('id');
        $this->filmRepository->delete($id);
    }
}