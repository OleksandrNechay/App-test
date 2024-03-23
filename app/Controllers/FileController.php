<?php

namespace App\Controllers;

use App\Helpers\FileHandle\FileHandler;
use App\Repositories\FilmRepository;
use App\Services\FileUploadService;

class FileController
{
    protected FilmRepository $filmRepository;
    protected FileUploadService $fileUploadService;

    public function __construct()
    {
        $this->filmRepository = new FilmRepository();
        $this->fileUploadService = new FileUploadService();
    }

    public function handle()
    {
        $uploadedFile = $_FILES['file'];
        $data = $this->fileUploadService->processFileUpload($uploadedFile);

        if(isset($data['exception'])) return json_encode($data);

        foreach ($data as $film) {
            $this->filmRepository->create($film);
        }

        return json_encode(['success' => true, 'message' => "File uploaded and processed successfully. Added " . count($data) . " new movies."]);
    }
}
