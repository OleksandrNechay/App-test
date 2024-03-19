<?php

namespace App\Helpers\FileHandle;

interface FileHandleContract
{
    public function handleContent(string $content): array;
}