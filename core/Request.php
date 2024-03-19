<?php

namespace Core;

class Request
{
    private array $options;

    public function __construct()
    {
        $this->options = $this->parseOptions();
    }

    private function parseOptions(): array
    {
        $queryString = $_SERVER['QUERY_STRING'] ?? '';
        parse_str($queryString, $queryArray);

        foreach ($queryArray as $key => $value) {
            $queryArray[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $queryArray;
    }

    public function getPath(): string
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        return parse_url($requestUri, PHP_URL_PATH);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getData(): array
    {
        $data = [];

        if($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value){
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $data;
    }

    public function setOptions(array $options): void
    {
        $this->options = array_merge($this->options, $options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOption(string $name, $default = null)
    {
        return $this->options[$name] ?? $default;
    }
}