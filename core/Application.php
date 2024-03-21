<?php

namespace Core;

use Database\DB;
use Database\QueryBuilder;

class Application
{
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public array $user;

    public function __construct()
    {
        self::$app = $this;
        DB::init();

        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router(request: $this->request, response: $this->response);

        if ($this->isAuthorized()) $this->setAppUser();
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function login($user): true
    {
        $this->session->set('user', $user['id']);
        return true;
    }

    public function logout(): void
    {
        $this->session->remove('user');
    }

    public function isAuthorized()
    {
       return $this->session->get('user');
    }

    public function setAppUser(): void
    {
        $this->user = QueryBuilder::make('users')->where('id', '=', $this->session->get('user'))->first();
    }
}