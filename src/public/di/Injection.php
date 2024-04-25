<?php

namespace di;

use handler\auth\AuthHandler;
use router\WebHook;
use router\WebHookInterface;
use service\security\Encryption;
use service\security\Hash;

class Injection
{
    static function inject(): WebHookInterface
    {
        $hashServiceInterface       = Hash::builder();
        $encryptServiceInterface = Encryption::builder();
        $authHandlerInterface       = AuthHandler::builder($hashServiceInterface, $encryptServiceInterface);
        return WebHook::builder($authHandlerInterface);
    }
}