<?php
namespace App\Infrastructure\Persistence\User;




class UpdateRepository 
{

    public function __construct(public Sql $db)
    {
        
    }


    protected function Update(){
        $stmt=$this->db->prepare("insert into estagiarios (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm) on duplicate key update nome=:nome,data_nascimento=:data");
        $var=[':nome'=>strtoupper(trim($cad->nome)),':data'=>$cad->data->getData()->format("Y-m-d"),':id'=>$primarykey,':id_adm'=>$id_adm];
        $this->db->setParms($stmt,$var);
    }
}