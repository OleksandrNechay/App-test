<?php

namespace App\Controllers\Auth;

use Core\Request;

class AuthController
{
    public function login(Request $request)
    {
        $data = $request->getData();

        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    public function register(Request $request)
    {
        $data = $request->getData();

        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}