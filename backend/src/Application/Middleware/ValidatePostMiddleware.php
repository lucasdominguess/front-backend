<?php
namespace App\Application\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class ValidatePostMiddleware
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
        $responseFactory = new ResponseFactory(); // Note that you will need to import
        $guard = new Guard($responseFactory);
        $csrfNameKey = $guard->getTokenNameKey();
        $csrfValueKey = $guard->getTokenValueKey();
       
        if (!$guard->validateToken($_POST[$csrfNameKey], $_POST[$csrfValueKey])) {
            // $response = $handler->handle($request);
            $response = new Response();
            
            return $response->withHeader('Location','/invalidtoken')->withStatus(302);
        }

        $response = $handler->handle($request);
        return $response;

    }
}