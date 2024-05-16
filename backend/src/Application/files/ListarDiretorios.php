<?php 
namespace App\Application\files;


class ListarDiretorios { 


    // public function __construct( $pasta)
    // { 
    //     $this->listar($pasta);
    // }
    public function listar($pasta){ 
        // $caminho = __DIR__ .$pasta; 
        $arquivos = scandir($pasta);
        array_shift($arquivos);
        array_shift($arquivos);
        return $arquivos ; 

    }

}
// $pasta = "C:/Users/x492420/OneDrive - rede.sp/Área de Trabalho/php_skeleton/src/Application/files/arquivos ";
// $pasta = __DIR__ ."/arquivos";

// chmod(__DIR__.'/../files',0755);
    // if(!is_dir($pasta)) {

    //     mkdir($pasta,0755);


    // }

// $arquivos = scandir($pasta);

// array_shift($arquivos);
// array_shift($arquivos);
// foreach ($arquivos as $arquivo) {
//    echo "$arquivo . \n ";
// }
// // // }; array_shift($arquivos);

// print_r($arquivos) ; 
// $diretorio = dir($pasta);
// while(($arquivo = $diretorio->read()) !== false) {
//  echo $arquivo."<br>";
// }