<?php

namespace Core;

use Database\DB;

class Application
{

    public Router $router;
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router(request: $this->request, response: $this->response);

        DB::init();
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}