<?php

namespace App\Helpers\FileHandle\Handlers;

use App\Helpers\FileHandle\FileHandleContract;
use App\Helpers\FileHandle\Validators\TxtValidator;

class TxtHandler implements FileHandleContract
{
    public function handleContent(string $content): array
    {
        $content = ltrim($content, "\xEF\xBB\xBF \t\n\r\0\x0B");
        $lines = explode("\n", $content);

        $film = [];
        $data = [];
        $validator = new TxtValidator();
        $allErrors = [];

        foreach ($lines as $line) {
            $this->extractField($line, 'Title:', $film, 'title');
            $this->extractField($line, 'Release Year:', $film, 'release_date');
            $this->extractField($line, 'Format:', $film, 'format');
            $this->extractField($line, 'Stars:', $film, 'actors');

            $errors = $validator->validate($line);

            $allErrors = array_merge_recursive($allErrors, $errors);

            if (isset($film['title']) && isset($film['release_date']) && isset($film['format']) && isset($film['actors'])) {
                $data[] = $film;
                $film = [];
            }
        }


        if (!empty($allErrors)) {
            return ['exception' => true, 'message' => 'File processing error. Incorrect data in the file', 'errors' => $allErrors];
        }

        return $data;
    }

    private function extractField(string $line, string $prefix, array &$film, string $fieldName): void
    {
        if (str_contains($line, $prefix)) {
            $value = trim(str_replace($prefix, '', $line));
            if ($fieldName === 'actors') {
                $film[$fieldName] = $this->sanitizeActors($value);
            } else {
                $film[$fieldName] = $value;
            }
        }
    }

    private function sanitizeActors(string $actorsString): string
    {
        $actorsArray = explode(',', $actorsString);
        return implode(', ', array_map('trim', $actorsArray));
    }
}