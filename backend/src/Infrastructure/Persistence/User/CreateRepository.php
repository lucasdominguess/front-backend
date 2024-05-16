<?php
namespace App\Infrastructure\Persistence\User;



class CreateRepository 
{

    public function __construct(public Sql $db)
    {
        
    }

    public function createUser($cad,$primarykey,$id_adm){
        $stmt=$this->db->prepare("insert into estagiarios (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm) on duplicate key update nome=:nome,data_nascimento=:data");
        $var=[':nome'=>strtoupper(trim($cad->nome)),':data'=>$cad->data->getData()->format("Y-m-d"),':id'=>$primarykey,':id_adm'=>$id_adm];
        $this->db->setParms($stmt,$var);
        $stmt->execute();
    }

    public function createAdmin($nome,$email,$senha,$nivel){ 
        $stmt=$this->db->prepare("insert into usuarios (nome,email,senha,nivel) values(:nome,:email,:senha,:nivel) on duplicate key update nome=:nome,email=:email,senha=:senha,nivel=:nivel");
        $var=[':nome'=>(trim($nome)),':email'=>$email,':senha'=>$senha,':nivel'=>$nivel];
        $this->db->setParms($stmt,$var);
        $stmt->execute();
    }
}