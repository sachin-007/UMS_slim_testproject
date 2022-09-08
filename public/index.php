<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

// require 'src/Controller/FirstController.php';

$container=  new Container();

$container->set('templating',function(){
    return new Mustache_Engine([
        'loader'=>new Mustache_Loader_FilesystemLoader(
            __DIR__. '/../templates',
            ['extension'=>'']
        )
        ]);
});

$container->set('session',function(){
    return new \SlimSession\Helper();
});

AppFactory::setContainer($container);


$app = AppFactory::create();

$app->add(new \Slim\Middleware\Session);

// $app->get('/','\App\Controller\FirstController:homepage');
$app->get('/hello','\App\Controller\SecoundController:hello');
$app->get('/hellop','\App\Controller\SecoundController:helloP');
$app->get('/default','\App\Controller\SearchController:default');
$app->get('/search','\App\Controller\SearchController:search');
$app->any('/form/search','\App\Controller\SearchController:form');
$app->get('/api', '\App\Controller\ApiController:ApiSearch');


// Authentication
$app->any('/','\App\Controller\AuthController:login');
$app->get('/logout','\App\Controller\AuthController:logout');
$app->get('/secure','\App\Controller\SecureController:Authdefault')->add(new \App\Middleware\Authenticate($app->getContainer()->get('session')));

// $app->get('/hello/{name}',function(Request $request,Response $response,array $args=[]){
//     $html=$this->get('templating')->render('hello.html',[
//         'name'=>$args['name']
//     ]);
//     $response->getBody()->write($html);
//     return $response;
// });

// $app->get('/hello/{name}',function(Request $request,Response $response,array $args=[]){
//     $html=$this->get('templating')->render('hello.php',[
//         'name'=>$args['name']
//     ]);
//     $response->getBody()->write($html);
//     return $response;
// });
$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define app routes
// $app->get('/hello/{name}', function (Request $request, Response $response,
// array $args) {
//     // $name = $args['name'];
//     $name=ucfirst($args['name']);
//     // $response->getBody()->write("Hello, $name");
//     $response->getBody()->write(sprintf("hello,%s!",$name));
//     return $response;
// });


// $app->get('/hello/{name}', function (Request $request, Response $response,array $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
//     return $response;
// });

// $app->get('/',function(Request $request,Response $response){
//     $response->getBody()->write("working there no problem");
//     return $response;
// });

// Run app
$app->run();