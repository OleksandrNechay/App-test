<?php

namespace Core;

class Router
{
    public Request $request;
    public Response $response;
    public Viewer $viewer;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->viewer = new Viewer();
    }

    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        // Check if the requested path ends with .js or .css
        if (preg_match('/\.(js|css)$/', $path, $matches)) {
            $fileExtension = $matches[1];

            $filePath = __DIR__ . "/../$path";
            if (file_exists($filePath)) {
                $contentType = $fileExtension === 'js' ? 'application/javascript' : 'text/css';
                $fileContent = file_get_contents($filePath);

                // Set response headers
                $this->response->setHeader('Content-Type', $contentType);
                $this->response->setStatusCode(200);

                return $fileContent;
            } else {
                $this->response->setStatusCode(404);
                return "404 Not found";
            }
        }

        // Handle dynamic routes
        foreach ($this->routes[$method] as $route => $handler) {
            $routePattern = str_replace('/', '\/', $route);
            $routePattern = preg_replace('/\{[^\}]+\}/', '([^\/]+)', $routePattern);
            if (preg_match('/^' . $routePattern . '$/', $path, $matches)) {
                array_shift($matches);
                $this->request->setOptions(array_combine($this->extractName($route), $matches));

                if (is_string($handler)) {
                    return $this->viewer->renderView($handler);
                }

                if (is_array($handler)) {
                    $handler[0] = new $handler[0]();
                }

                return call_user_func($handler, $this->request);
            }
        }

        return $this->viewer->notFound();
    }

    private function extractName(string $route): array
    {
        preg_match_all('/\{([^\/]+)\}/', $route, $matches);
        return $matches[1];
    }
}