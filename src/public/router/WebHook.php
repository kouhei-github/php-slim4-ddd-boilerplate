<?php

namespace router;

use handler\user\UserHandler;
use handler\user\UserHandlerInterface;
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
    public UserHandlerInterface $userHandler;

    function __construct(
        AuthHandlerInterface $authHandler,
        UserHandlerInterface $userHandler,
    ) {
        $this->authHandler = $authHandler;
        $this->userHandler = $userHandler;
    }

    public function register(): App
    {
        $app = AppFactory::create();

        $app->group('/api/v1', function (\Slim\Routing\RouteCollectorProxy $group) {
            // グループ化 => /api/v1/~
            $group->get('/', fn(Request $request, Response $response, $args) => $this->authHandler->login($request, $response, $args));
            $group->get('/login', fn(Request $request, Response $response, $args) => $this->authHandler->login($request, $response, $args));
            $group->group('/user', function (\Slim\Routing\RouteCollectorProxy $group) {
                // グループ化 => /api/v1/user/~
                $group->post('/', fn(Request $request, Response $response, $args) => $this->userHandler->createUser($request, $response, $args));
                $group->get('/{id}', fn(Request $request, Response $response, $args) => $this->userHandler->findUserById($request, $response, $args));
            });
        });

        return $app;
    }

    static function builder(
        AuthHandlerInterface $authHandler,
        UserHandlerInterface $userHandler,
    ): WebHookInterface {
        return new static($authHandler, $userHandler);
    }
}