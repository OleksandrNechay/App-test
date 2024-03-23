<?php

namespace App\Helpers\FileHandle\Validators;

class TxtValidator
{
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            'title' => [
                'required' => true,
                'maxLength' => 255,
            ],
            'release_date' => [
                'required' => true,
                'min' => 1900,
                'max' => date('Y'),
            ],
            'format' => [
                'required' => true,
                'maxLength' => 50,
            ],
            'actors' => [
                'required' => true,
                'pattern' => '/^[A-Za-z,\' \-\']+$/',
            ],
        ];
    }

    public function validate(string $line): array
    {
        $errors = [];

        $this->extractField($line, 'Title:', $errors, 'title');
        $this->extractField($line, 'Release Year:', $errors, 'release_date');
        $this->extractField($line, 'Format:', $errors, 'format');
        $this->extractField($line, 'Stars:', $errors, 'actors');

        return $errors;
    }

    private function extractField(string $line, string $prefix, array &$errors, string $fieldName): void
    {
        if (str_contains($line, $prefix)) {
            $value = trim(str_replace($prefix, '', $line));

            if ($fieldName === 'release_date' && (!is_numeric($value) || $value < $this->rules['release_date']['min'] || $value > $this->rules['release_date']['max'])) {
                $errors[$fieldName][] = 'Release Year should be between ' . $this->rules['release_date']['min'] . ' and ' . $this->rules['release_date']['max'];
            } elseif ($fieldName === 'actors' && !preg_match('/^[A-Za-z,\' \-\']+$/', $value)) {
                $errors[$fieldName][] = 'Actors should only contain letters, hyphens, commas, and single quotes';
            } elseif (empty($value)) {
                $errors[$fieldName][] = ucfirst($fieldName) . ' is required';
            }
        }
    }
}

