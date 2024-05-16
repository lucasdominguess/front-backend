<?php
namespace App\classes;


class VerificarEmail 
{

    public function __construct(string $email)
    {
        $this->ver_email($email);
    }

    public function ver_email($email)
    {   
        $email2 = $_POST['email']; 

        // if (empty($email2)) {   //Regex para validar formado de nome com min. de 3
        //     $response=['status' => 'fail', 'msg' => 'O Email não pode estar em branco'];
        //     return $response;
        //     exit();
        // }
        if (!preg_match("/^([a-zàáâãçèéêìíîòóôõùúû'_.]{4,}@[\w]{5,10}\.(sp|com)(.gov)?(.br)?|root)$/im", $email2)) {   //Regex para validar formado de nome com min. de 3
            $response=['status' => 'fail', 'msg' => 'Email Inválido!'];
            return $response;
            exit();
        }
        // return $email2 ;
    }
}
