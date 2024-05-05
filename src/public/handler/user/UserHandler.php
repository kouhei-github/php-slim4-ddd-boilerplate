<?php

namespace handler\user;

use domain\entities\EntUser;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use repository\UserRepositoryInterface;

interface UserHandlerInterface
{
    function findUserById(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface;
    function createUser(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface;
}

class UserHandler implements UserHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findUserById(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $userId = $args["id"];
        $user = $this->userRepository->getUserById((int)$userId);
        if (count($user) === 0) {
            $response->getBody()->write(json_encode(["message" => "userId not found"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        $response->getBody()->write(json_encode($user));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function createUser(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $body  = json_decode($request->getBody());
        $name  = $body->name;
        $email = $body->email;

        $user  = new EntUser($name, $email);

        $user = $this->userRepository->save($user);
        if (count($user) === 0) {
            $response->getBody()->write(json_encode(["message" => "Failed to save user"]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
        $response->getBody()->write(json_encode($user));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    static function builder(UserRepositoryInterface $userRepository): UserHandlerInterface
    {
        return new static($userRepository);
    }
}