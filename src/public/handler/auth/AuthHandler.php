<?php

namespace handler\auth;

use domain\vd\security\AlgorithmDomain;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use repository\UserRepositoryInterface;
use service\security\EncryptionInterface;
use service\security\HashInterface;

interface AuthHandlerInterface
{
    public function login(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface;
}

class AuthHandler implements AuthHandlerInterface
{
    private HashInterface $hashService;
    private EncryptionInterface $encryptService;
    function __construct(
        HashInterface $hashService,
        EncryptionInterface $encryptService)
    {
        $this->encryptService = $encryptService;
        $this->hashService    = $hashService;
    }

    public function login(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $algo    = new AlgorithmDomain(PASSWORD_BCRYPT);
        $hashed  = $this->hashService->password_hash("test", $algo);
        $data    = ["before" => "test", "hash" => $hashed];
        $payload = json_encode(
            $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK
        );
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    static function builder(HashInterface $hashService, EncryptionInterface $encryptService): AuthHandlerInterface
    {
        return new static(
            $hashService,
            $encryptService
        );
    }
}