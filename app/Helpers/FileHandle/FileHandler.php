<?php

namespace App\Helpers\FileHandle;

use App\Helpers\FileHandle\Handlers\TxtHandler;

class FileHandler
{
    protected array $file;
    protected string $extension;
    protected array $allowedExtensions = ['txt'];

    public function __construct(array $file)
    {
        $this->file = $file;
        $this->extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    }

    public static function make(array $file): FileHandler
    {
        return new self($file);
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