<?php

namespace App\Controllers\Site;

use App\Filters\Film\FilmFilterDTO;
use App\Repositories\FilmRepository;
use Core\Request;
use Core\Response;
use Core\Viewer;

class FilmController
{
    protected Viewer $viewer;
    protected FilmRepository $filmRepository;

    public function __construct()
    {
        $this->viewer = new Viewer();
        $this->filmRepository = new FilmRepository();
    }

    public function index(Request $request)
    {
        $inputs = FilmFilterDTO::make($request);

        $films = $this->filmRepository->filter($inputs)->get();

        return $this->viewer->renderView('films', [
            'films' => $films,
            'search' => $inputs->search
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->getData();

        $isCreated = $this->filmRepository->create($data);

        $responseHandler = new Response();
        return $responseHandler->json(['isCreated' => $isCreated]);
    }

    public function show(Request $request)
    {
        $id = $request->getOption('id');

        $film = $this->filmRepository->findById($id);

        if (!$film) return $this->viewer->notFound();

        return $this->viewer->renderView('film', [
            'film' => $this->filmRepository->findById($id)
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->getOption('id');
        $this->filmRepository->delete($id);

    }
}