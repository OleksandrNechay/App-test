<?php

namespace Core;

class View
{
    private string $baseDir = __DIR__ . "/../resources/views";
    private string $view;

    public function __toString(): string
    {
        return $this->view;
    }

    public function render(string $view, array $options = []): self
    {
        $viewContent = $this->getViewContent($view, $options);
        $processedContent = $this->insertComponents($viewContent);

        $this->view = $processedContent;
        return $this;
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

    protected function insertComponents($content): array|string
    {
        ob_start();
        include_once $this->baseDir . "/sections/header.php";
        $header = ob_get_clean();

        ob_start();
        include_once $this->baseDir . "/sections/footer.php";
        $footer = ob_get_clean();

        // Replace placeholders with actual content
        $content = str_replace('@header', $header, $content);
        $content = str_replace('@footer', $footer, $content);

        // Check for @include directive
        $content = preg_replace_callback('/@include\([\'"]([^\'"]+)[\'"]\)/', function ($matches) {
            $file = $this->baseDir . "/" . $matches[1] . '.php';
            if (file_exists($file)) {
                ob_start();
                include $file;
                return ob_get_clean();
            } else {
                return ''; // Return empty string if file not found
            }
        }, $content);

        return $content;
    }

    public function notFound(): View
    {
        $response = new Response();
        $response->setStatusCode(404);
        return $this->render('404');
    }
}
