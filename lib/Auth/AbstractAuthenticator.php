<?php
namespace Spark\Auth;

use Psr\Http\Message\ServerRequestInterface as Request;

abstract class AbstractAuthenticator
{
    abstract public function getToken(Request $request);

    abstract public function isValid($token);

    public function getErrorMessage()
    {
        return 'The token in invalid';
    }
}