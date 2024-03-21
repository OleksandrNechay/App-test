<?php

namespace Core;

class Response
{
    public function setStatusCode(int $statusCode): void
    {
        http_response_code($statusCode);
    }

    public function setHeader(string $name, string $value): void
    {
        header("$name: $value");
    }

    public function redirect(string $url, int $statusCode = 301): void
    {
        $this->setStatusCode($statusCode);
        header('Location:' . $url);
    }

    public function json(array $data, int $statusCode = 200): false|string
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Content-Type', 'application/json');
        return json_encode($data);
    }
}