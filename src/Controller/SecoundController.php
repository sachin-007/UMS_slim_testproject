<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use psr\Http\Message\ServerRequestInterface as Request;


class SecoundController extends Controller
{
    public function hello(Request $request,Response $response){
        return $this->render($response,'hello.html',['name'=>'Sachin']);
    }

    public function helloP(Request $request,Response $response){
        return $this->render($response,'hello.php',['name'=>'Sachin']);
    }
}
