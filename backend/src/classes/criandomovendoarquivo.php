<?php 

$nome_arquivo = date('Y-m-d-H-i-s') . ".csv" ; 
$arquivo = fopen($nome_arquivo,"w+");
fwrite($arquivo , 'Linha 1' . PHP_EOL);
fwrite($arquivo , 'Linha 2' . PHP_EOL);
fclose($arquivo);
$move_arquivo = "$pasta/$nome_arquivo" ; 
rename($nome_arquivo,$move_arquivo); 
echo $move_arquivo ;