<?php 
namespace App\Application\files;



class Upload { 
   
    private $name ; 
    private $extension; 
    private $tmpName; 
    private $error;
    private $size ; 
    private $type ; 
    
    public function __construct($file){

        $this->type =$file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error= $file['error']; 
        $this->size=$file['size'];

        $info = pathinfo($file['name']);
        $this->name = $info['filename'];
        $this->extension =  pathinfo($file['name'],PATHINFO_EXTENSION);
    }
    public function getBasename(){
        $extension = strlen($this->extension) ? '.' .$this->extension : '' ;
        return $this->name.$extension ; 
    }
        
    public function upload($dir){
      
      

        $path =$dir .'/arquivos'.$this->getBasename(); 
        return move_uploaded_file($this->tmpName,$path) ;
    }

}