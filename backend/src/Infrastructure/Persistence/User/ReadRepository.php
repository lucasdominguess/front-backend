<?php
namespace App\Infrastructure\Persistence\User;



class ReadRepository 
{

    public function __construct(public Sql $db)
    {
        
    }

    
    public function estagisFindAll(): array
    {
        $stmt = $this->db->prepare("select * from estagiarios");
       
        $stmt->execute();
        $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
    public function estagisFindId($id)

    {
        $stmt =$this->db->prepare("select * from estagiarios where id = :id");
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }

    public function admsFindAll(): array
    {
        $stmt = $this->db->prepare("select id_adm,nome,email ,nivel from usuarios");
       
        $stmt->execute();
        $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
    public function admFindId($id)
    {
        $stmt =$this->db->prepare("select * from usuarios where id_adm = :id");
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
    public function tentativasFindAll(): array
    {
        $stmt = $this->db->prepare("select * from tentativa");
       
        $stmt->execute();
        $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
    public function tentativasFindId($id)

    {
        $stmt =$this->db->prepare("select * from tentativa where id = :id");
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch(\PDO::FETCH_ASSOC); 
        
        return $resultado;
    }
}