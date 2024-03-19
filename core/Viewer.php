<?php

namespace Core;

class Viewer
{
    private string $baseDir = __DIR__ . "/../resources/views";

    public function renderView(string $view, array $options = []): array|string
    {
        $viewContent = $this->getViewContent(view: $view, options: $options);
        $processedContent = $this->insertComponents($viewContent, options: $options);

        return $processedContent;
    }

    protected function getViewContent(string $view, array $options): false|string
    {
        foreach ($options as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include $this->baseDir . "/pages/$view.php";
        return ob_get_clean();
    }

    protected function insertComponents($content, array $options = []): array|string
    {
        $header = file_get_contents($this->baseDir . "/sections/header.php");
        $footer = file_get_contents($this->baseDir . "/sections/footer.php");

        // Replace placeholders with actual content
        $headerContent = $this->getViewContent('header', $options);
        $content = str_replace('@header', $header, $content);
        $content = str_replace('@footer', $footer, $content);

        // Check for @include directive
        $content = preg_replace_callback('/@include\([\'"]([^\'"]+)[\'"]\)/', function ($matches) {
            $file = $this->baseDir . "/" . $matches[1] . '.php';
            if (file_exists($file)) {
                return file_get_contents($file);
            } else {
                return ''; // Return empty string if file not found
            }
        }, $content);

        return $content;
    }

    public function notFound(): array|string
    {
        $response = new Response();
        $response->setStatusCode(404);
        return $this->renderView('404');
    }
}