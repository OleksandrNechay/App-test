<?php

namespace App\Controllers;

use App\Helpers\FileHandle\FileHandler;
use App\Repositories\FilmRepository;

class FileController
{
    protected FilmRepository $filmRepository;

    public function __construct()
    {
        $this->filmRepository = new FilmRepository();
    }

    public function handle()
    {
        if (!isset($_FILES['file'])) return json_encode(['error' => 'No file uploaded']);

        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $fileContent = file_get_contents($_FILES['file']['tmp_name']);

        $handler = FileHandler::make($extension)->get();
        $films = $handler->handleContent($fileContent);

        foreach ($films as $filmData) {
            $this->filmRepository->create($filmData);
        }

        return json_encode(['message' => 'File uploaded and processed successfully']);
    }
}
