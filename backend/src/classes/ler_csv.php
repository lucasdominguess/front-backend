<?php
// require __DIR__ .'/vendor/autoload.php' ;

// use App\Infrastructure\Persistence\User\Sql;
// use League\Csv\Reader;

// $db = new Sql();
// // We are going to insert some data into the users table
// $sth = $db->prepare(
//     "INSERT INTO registros (firstname, lastname, email) VALUES (:firstname, :lastname, :email)"
// );

// $csv = Reader::createFromPath('./file.csv','r+')
//     ->setHeaderOffset(0)

$arquivo = __DIR__.'/dados.csv'; 
$file = fopen($arquivo,'r'); 

$l = fgetcsv($file ,null,); 
// foreach ($l as $record) { 

// }

print_r($l);



// foreach ($csv as $record) {
//     // Do not forget to validate your data before inserting it in your database
//     $sth->bindValue(':firstname', $record['firstname'] , PDO::PARAM_STR);
//     $sth->bindValue(':lastname', $record['lastname'], PDO::PARAM_STR);
//     $sth->bindValue(':email', $record['email'], PDO::PARAM_STR);
//     $sth->execute();
// }