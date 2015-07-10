<?php
namespace App\Data;

use Spark\Auth\AbstractAuthenticator;
use Psr\Http\Message\ServerRequestInterface as Request;

class Authenticator extends AbstractAuthenticator
{
    public function getToken(Request $request)
    {
        return $request->getHeader('Authorization');
    }

    public function isValid($token)
    {
        return false;
    }
}