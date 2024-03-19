<?php

namespace App\Helpers\FileHandle;

use App\Helpers\FileHandle\Handlers\TxtHandler;

class FileHandler
{
    protected string $extension;
    protected array $allowedExtensions = ['txt'];

    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    public static function make(string $extension): FileHandler
    {
        return new self($extension);
    }

    public function get(): FileHandleContract
    {
        return match ($this->extension) {
            'txt' => new TxtHandler(),
//            'csv' => new CsvHandler(),
//            'xml' => new XmlHandler(),
            default => new TxtHandler()
        };
    }

    public function isAllowedExtension(): bool
    {
        return in_array($this->extension, $this->allowedExtensions);
    }
}