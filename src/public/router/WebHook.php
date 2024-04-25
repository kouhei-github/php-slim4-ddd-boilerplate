<?php

namespace router;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Factory\AppFactory;

use handler\auth\AuthHandlerInterface;

interface WebHookInterface
{
    public function register(): App;
}

class WebHook implements WebHookInterface
{
    public AuthHandlerInterface $authHandler;
    function __construct(
        AuthHandlerInterface $authHandler
    ) {
        $this->authHandler = $authHandler;
    }

    public function register(): App
    {
        $app = AppFactory::create();
        $app->get('/', function (Request $request, Response $response, $args) {return $this->authHandler->login($request, $response, $args);});
        $app->get('/login', function (Request $request, Response $response, $args) {return $this->authHandler->login($request, $response, $args);});
        return $app;
    }

    static function builder(AuthHandlerInterface $authHandler): WebHookInterface
    {
        return new static($authHandler);
    }
}