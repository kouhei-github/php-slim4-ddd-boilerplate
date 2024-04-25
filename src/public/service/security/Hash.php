<?php

namespace service\security;


use domain\security\AlgorithmDomain;

interface HashInterface
{
    public function password_hash(string $password, AlgorithmDomain $algo): string;
    public function password_verify(string $password, string $hash): bool;
}

class Hash implements HashInterface
{
    public function password_hash(string $password, AlgorithmDomain $algo): string
    {
        return password_hash($password, $algo->getAlgo());
    }

    public function password_verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    static function builder(): HashInterface
    {
        return new static();
    }
}