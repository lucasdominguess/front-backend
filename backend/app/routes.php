<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;


use App\Application\Middleware\UserMiddleware;
use App\Application\Middleware\AdminMiddleware;
use App\Application\Middleware\TokenMiddleware;

use App\Application\Actions\sender\HandleSenderAction;
use App\Application\Middleware\ValidatePostMiddleware;
use App\Application\Actions\User\controlers\LogarAction;
use App\Application\Actions\User\controlers\EditarAction;
use App\Application\Actions\User\controlers\ListarAction;
use App\Application\Actions\User\controlers\UploadAction;
use App\Application\Actions\User\controlers\ExcluirAction;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\User\controlers\DownloadAction;
use App\Application\Actions\User\controlers\CadastrarAction;
use App\Application\Actions\User\controlers\SairSessaoAction;
use App\Application\Actions\User\controlers\ListarArquivosAction;

return function (App $app) {

// $app->options('/{routes:.*}', function (Request $request, Response $response) {
    //     // CORS Pre-Flight OPTIONS Request Handler
    //     return $response;
    // });

    // // $app->get('/', function (Request $request, Response $response) {
    // //     $response->getBody()->write('Hello world!');
    // //     return $response;
    // // });

    // $app->group('/users', function (Group $group) {
    //     $group->get('', ListUsersAction::class);
    //     $group->get('/{id}', ViewUserAction::class);
       
    // });
    

    
    $app->get('/', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'index.html', [
          
        ]);
    })->setName('login');
    $app->get('/sender', HandleSenderAction::class);

    // $app->get('/logar', function ($request, $response,$args) {
    //     //  echo json_encode('chegou no app da rota');
    //     $view = Twig::fromRequest($request);
    //     return $view->render($response, 'registrar.php', [
          
    //     ]);
    // });
        
      
    // $app->get('/log', function ($request, $response, $args) {
    //     $view = Twig::fromRequest($request);
    //     return $view->render($response, 'logs.php', [
          
    //     ]);
    // });
        
    //ROTAS PUBLICAS
        $app->post('/logar',LogarAction::class);
        // ->add(ValidatePostMiddleware::class); //efetuar login 
        $app->post('/sair',SairSessaoAction::class); //sair da sessao
        $app->get('/listar',ListarAction::class); //listar dados para tabela
        $app->post('/cadastrar',CadastrarAction::class); //efetuar cadastro
        
        
       

        $app->get('/invalidtoken', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'index.html', [
          
        ]);
    })->setName('tokenInvalido');

   //ROTAS DE ADMIN 
    $app->group('/admin',function(Group $group){ 
        $group->get('/home_adm', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response, '/admin/home.html', [
              
            ]);
            })->setName('home_adm');
        
        $group->get('/editar',EditarAction::class);
        $group->post('/excluir',ExcluirAction::class);
        $group->get('/exibir_admins',ListarAction::class);
        $group->get('/exibiradmins', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response,'/admin/exibiradmins.html', [
              
            ]);
            });
        $group->get('/tentativas_acesso',ListarAction::class);   
        $group->get('/tentativasacesso', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response,'/admin/tentativas_acesso.html', [
              
            ]);
        });
        $group->get('/configadms' ,function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response,'/admin/config_adms.html', [
              
            ]);
        });
        $group->post('/upload_arquivo',UploadAction::class);
        $group->get('/listar_arquivos',ListarAction::class);
        $group->get('/listar_diretorio',ListarArquivosAction::class);
        $group->get('/download',DownloadAction::class);
        // $group->get('/download/{filename}',DownloadAction::class);


    });
    // ->add(new TokenMiddleware())->add(new AdminMiddleware());


    // rotas Usuarios
    $app->group('/user',function(Group $group){ 
        $group->get('/home_user', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response, '/users/home_users.html', [
              
            ]);
            })->setName('home_user')->add(new TokenMiddleware())->add(new UserMiddleware());
            

    });


 

    };
