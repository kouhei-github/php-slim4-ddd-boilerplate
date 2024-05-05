<?php

namespace di;

use handler\auth\AuthHandler;
use handler\user\UserHandler;
use repository\UserRepository;
use router\WebHook;
use router\WebHookInterface;
use service\security\Encryption;
use service\security\Hash;

class Injection
{
    static function inject(): WebHookInterface
    {
        $userRepositoryInterface = UserRepository::builder();
        $userHandlerInterface    = UserHandler::builder($userRepositoryInterface);
        $hashServiceInterface    = Hash::builder();
        $encryptServiceInterface = Encryption::builder();
        $authHandlerInterface    = AuthHandler::builder($hashServiceInterface, $encryptServiceInterface);
        return WebHook::builder($authHandlerInterface, $userHandlerInterface);
    }
}