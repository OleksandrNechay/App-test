<?php

namespace App\Helpers\FileHandle\Handlers;

use App\Helpers\FileHandle\FileHandleContract;

class CsvHandler implements FileHandleContract
{
    public function handleContent(string $content): array
    {
        return [];
    }
}