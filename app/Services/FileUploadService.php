<?php

namespace App\Services;

use App\Helpers\FileHandle\FileHandler;

class FileUploadService
{
    public function processFileUpload(array $uploadedFile): array
    {
        if (!isset($uploadedFile['error']) || $uploadedFile['error'] !== UPLOAD_ERR_OK) {
            return ['exception' => true, 'message' => 'No file uploaded or file upload error occurred'];
        }

        if ($uploadedFile['size'] === 0) {
            return ['exception' => true, 'message' => 'File is empty'];
        }

        $handler = FileHandler::make($uploadedFile);
        if (!$handler->isAllowedExtension()) {
            return ['exception' => true, 'message' => 'Invalid file extension. The system supports only .txt format'];
        }

        $fileContent = file_get_contents($uploadedFile['tmp_name']);
        return $handler->get()->handleContent($fileContent);
    }
}
