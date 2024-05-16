<?php
namespace App\Application\Middleware;

use Slim\Psr7\Response;
use App\Domain\User\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class UserMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  Request        $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {

        if (!isset($_SESSION[User::USER_ID]) || $_SESSION[User::USER_ID] == 5 ) {
            $response = new Response();

            return $response->withHeader('Location', '/')->withStatus(302);
        }

        $response = $handler->handle($request);
        return $response;

    }
}