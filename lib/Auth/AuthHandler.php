<?php
namespace Spark\Auth;

use Auryn\Injector;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthHandler
{

    protected $authenticator;
    protected $injector;

    public function __construct(AbstractAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {

        $token = $this->authenticator->getToken($request);

        if ($token && !$this->authenticator->isValid($token)) {
            throw new \Exception($this->authenticator->getErrorMessage());
        }

        return $next($request, $response);
    }
}