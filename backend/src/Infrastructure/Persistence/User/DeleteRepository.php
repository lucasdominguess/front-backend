<?php
namespace App\Infrastructure\Persistence\User;



class DeleteRepository 
{

    public function __construct(public Sql $db)
    {
        
    }


    public function deleteAll()
    {
        $stmt = $this->db->prepare("delete * from :table");
        $stmt->execute();
    
        
       
    }
    public function Delete_EstagiariosOfId($id)
    {
        $stmt =$this->db->prepare("delete from estagiarios where id = :id");
  
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        
        
      
    }
    public function Delete_AdminsOfId($id)
    {
        $stmt =$this->db->prepare("delete from usuarios where id_adm = :id");
  
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        
        
      
    }
    public function Delete_TentativasOfId($id)
    {
        $stmt =$this->db->prepare("delete from tentativa where id = :id");
  
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        
   
      
    }
}