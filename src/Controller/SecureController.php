<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use psr\Http\Message\ServerRequestInterface as Request;

class SecureController extends Controller
{
    public function Authdefault(Request $request,Response $response)
    {
        if($this->ci->get('session')->get('user')==null){
            return $response->withRedirect('/');
        }
        return $this->render($response,'Authdefault.html',[
            'user'=>$this->ci->get('session')->get('user')
        ]);
    }
}