<?php

// use DateTime;
use App\Domain\User\User;
use PHPUnit\TextUI\XmlConfiguration\Constant;

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
ini_set('default_charset', 'UTF-8');
 
$GLOBALS['TZ'] = new \DateTimeZone( 'America/Sao_Paulo');
$GLOBALS['datefull'] = (new DateTime('now', $GLOBALS['TZ']))->format('d-m-Y H:i:s');
$GLOBALS['datefull2'] = (new DateTime('now', $GLOBALS['TZ']))->format('Y-m-d H:i:s');
$GLOBALS['datefullForm'] = (new DateTime('now', $GLOBALS['TZ']))->format('Y-m-d H:i:s');
$GLOBALS['hours'] = (new DateTime('now',$GLOBALS['TZ']))->format('H:i:s');
$GLOBALS['days'] = (new DateTime('now',$GLOBALS['TZ']))->format('d-m-Y');

define('USER_DATA', $GLOBALS['hours']);

// Definindo variaveis globais para usuario 

$id_adm = $_SESSION[User::USER_ID] ?? null ;
define('USERID',$id_adm);
$nome = $_SESSION[User::USER_NAME] ?? '' ; 
define('USERNAME',$nome);

$email = $_SESSION[User::USER_EMAIL] ?? '' ; 
define('USEREMAIL',$email );

$nivel = $_SESSION[User::USER_NIVEL] ?? null;
define('USER_NIVEL',$nivel);

// tempo de expiração de token 
$expToken = $_SESSION['EXP_TOKEN'] ?? '';
$formExp= (new DateTime($expToken))->format('H:i:s');
define('EXP_TOKEN',$expToken);

//definindo caminhos das paginas 
define('URL_HOMEUSER',"http://{$_SERVER['HTTP_HOST']}/user/home_user");
define('URL_HOMEADM',"http://{$_SERVER['HTTP_HOST']}/admin/home_adm");

define('URL_EXIBIR_ADMIN',"http://{$_SERVER['HTTP_HOST']}/admin/exibiradmins");
define('URL_TENTA_ACESSO',"http://{$_SERVER['HTTP_HOST']}/admin/tentativasacesso");
define('URL_ARQUIVOS_ADM',"http://{$_SERVER['HTTP_HOST']}/admin/configadms");

//definindo caminho 
define('URI_SERVER', $_SERVER['HTTP_REFERER'] ?? null); //http://localhost:9000/user/home_user
define('IP_SERVER', $_SERVER['REMOTE_ADDR'] ?? NULL ); //"127.0.0.1"

// define('URI_SERVER', $_SERVER['PATH_INFO'] ?? null );

