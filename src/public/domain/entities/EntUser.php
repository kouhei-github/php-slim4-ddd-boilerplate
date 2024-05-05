<?php

namespace domain\entities;

class EntUser
{
    private string $email;
    private string $name;
    public function __construct(string $name, string $email)
    {
        if ($name === ""){
            throw new \Exception('ユーザー名が存在しません。');
        }
        $this->name = $name;
        if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \Exception('メールアドレスが正しくありません');
        }
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Fetches the records of the object.
     *
     * @return array An associative array containing the name and email of the object.
     */
    public function records(): array
    {
        return [
            "name"  => $this->name,
            "email" => $this->email,
        ];
    }
}