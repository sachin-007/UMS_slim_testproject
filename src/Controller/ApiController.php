<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use psr\Http\Message\ServerRequestInterface as Request;


class ApiController extends Controller
{

    public function ApiSearch(Request $request,Response $response){
        $albums = json_decode(file_get_contents(__DIR__.'/../../data/albums.json'),true);

        $query=$request->getQueryParam('q');

        if($query){
            $albums=array_values(array_filter($albums,function($album) use ($query){
                return strpos($album['title'],$query)!==false || strpos($album['artist'],$query)!==false;
            }));
        }

        return  $response->withJson($albums);
        // return $this->render($response,'search.html',[
        //     'albums'=>$albums,
        //     'query'=>$query
        // ]);
    }

}
