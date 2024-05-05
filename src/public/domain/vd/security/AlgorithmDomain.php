<?php

namespace domain\vd\security;

const ALGORITHMS =[PASSWORD_BCRYPT, PASSWORD_DEFAULT, PASSWORD_ARGON2I, PASSWORD_ARGON2ID];

class AlgorithmDomain
{
    private string $algo;
    function __construct(string $algo)
    {
        if(!in_array($algo, ALGORITHMS)){
            throw new \Exception('アルゴリズムが存在しません。');
        }
        $this->algo = $algo;
    }

    public function getAlgo(): string
    {
        return $this->algo;
    }
}