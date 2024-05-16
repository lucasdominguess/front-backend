<?php
namespace App\Infrastructure;
abstract class Helpers{
    public static function dd(mixed $var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die();
       
        // die(var_dump($var));
    }
 
}