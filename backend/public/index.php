<?php

declare(strict_types=1);
@session_start();
use Slim\Csrf\Guard;
use Slim\Views\Twig;
use DI\ContainerBuilder;
use App\Domain\User\User;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use App\Application\Extension\CsrfExtension;
use App\Application\Handlers\ShutdownHandler;
// use App\Application\Actions\User;
use Slim\Factory\ServerRequestCreatorFactory;
use App\Application\Handlers\HttpErrorHandler;
use App\Application\Settings\SettingsInterface;
use App\Application\ResponseEmitter\ResponseEmitter;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php' ;

// $GLOBALS['TZ'] = new \DateTimeZone( 'America/Sao_Paulo');


// define('USERID',$_SESSION[ User::USER_ID]) ?? '';
// define('USERNAME',$_SESSION[ User::USER_NAME]) ?? '';
// define('USEREMAIL',$_SESSION[ User::USER_EMAIL]) ?? '';
// define('USERSESSION',$_SESSION[ User::USER_DATE]) ?? '';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Set up settings
$settings = require __DIR__ . '/../app/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/../app/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();

// $config = parse_ini_file(__DIR__ .'../config');
$env = parse_ini_file(__DIR__ .'/../.env');
// Create Twig
$twig = Twig::create(__DIR__ .'/../views', ['cache' => false]);
$container->set('view',$twig);
// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));



$callableResolver = $app->getCallableResolver();

// Register middleware
$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

/** @var SettingsInterface $settings */
$settings = $container->get(SettingsInterface::class);

$displayErrorDetails = $settings->get('displayErrorDetails');
$logError = $settings->get('logError');
$logErrorDetails = $settings->get('logErrorDetails');

// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Create Error Handler
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

//Criando guard 
$guard = new Guard($responseFactory);
$twig->addExtension(new CsrfExtension($guard));

// Generate new tokens
function gerar_token()
{
    global $guard;
    $csrfNameKey = $guard->getTokenNameKey();
    $csrfValueKey = $guard->getTokenValueKey();
    $keyPair = $guard->generateToken();
}

gerar_token();
// Create Shutdown Handler
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Body Parsing Middleware
$app->addBodyParsingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logError, $logErrorDetails);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);

// $username = $_SESSION[User::USER_NAME]?? '';
// define('username',$username);

