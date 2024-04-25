<?php

namespace service\security;

const KEY ="someRandomKey";

interface EncryptionInterface
{
    public function encrypt(string $data, string $key): string;
    public function decrypt(string $encrypted): bool|string;
}

class Encryption implements EncryptionInterface
{
    private string $iv;
    function __construct()
    {
        $this->iv = random_bytes(16);   // 初期化ベクトル (16バイト)
    }

    public function encrypt(string $data, string $key): string
    {
        return openssl_encrypt($data, 'AES-256-CBC', $key, 0, $this->iv);
    }

    public function decrypt(string $encrypted): bool|string
    {
        return openssl_decrypt($encrypted, "AES-256-CBC", KEY, 0, $this->iv);
    }

    static function builder(): EncryptionInterface
    {
        return new static();
    }
}