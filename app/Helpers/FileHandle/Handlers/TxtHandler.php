<?php

namespace App\Helpers\FileHandle\Handlers;

use App\Helpers\FileHandle\FileHandleContract;

class TxtHandler implements FileHandleContract
{
    public function handleContent(string $content): array
    {
        $content = ltrim($content, "\xEF\xBB\xBF \t\n\r\0\x0B");

        $data = [];
        $lines = explode("\n", $content);

        $film = [];
        foreach ($lines as $line) {
            if (str_contains($line, 'Title:')) {
                $film['title'] = trim(str_replace('Title:', '', $line));
            } elseif (str_contains($line, 'Release Year:')) {
                $film['release_date'] = trim(str_replace('Release Year:', '', $line));
            } elseif (str_contains($line, 'Format:')) {
                $film['format'] = trim(str_replace('Format:', '', $line));
            } elseif (str_contains($line, 'Stars:')) {
                $actorsString = trim(str_replace('Stars:', '', $line));
                $actorsArray = explode(',', $actorsString);
                $film['actors'] = implode(', ', array_map('trim', $actorsArray));
            }

            if (isset($film['title']) && isset($film['release_date']) && isset($film['format']) && isset($film['actors'])) {
                $data[] = $film;
                $film = [];
            }
        }

        return $data;
    }
}