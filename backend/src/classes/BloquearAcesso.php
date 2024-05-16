<?php 
namespace App\classes;


use PDO;
use DateTime;
use DateTimeZone;
use App\Infrastructure\Persistence\User\Sql;

class BloquearAcesso { 
   


    function bloqueio($email,$db){
                $logger = new CreateLogger();
               //Verificando se o email ja existe no banco de tentativas incorretas de login 
                $stmt = $db->prepare("SELECT COUNT(*) AS total FROM tentativa WHERE emails = :email");
                $stmt->bindValue(":email", $email);
                $stmt->execute();

                        
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $row['total'];

                if ($count <= 2) 
                {
                    $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
                    $hr_bloq = date_add($datenow,date_interval_create_from_date_string('+1 minutes'));
                    $hr = $hr_bloq->format("y-m-d H:i:s");
                    $stmt=$db->prepare("insert into tentativa (emails,data) values(:email,:date)") ;
                    $stmt->bindValue(":email",$email);
                    $stmt->bindValue(":date",$hr);
                    $stmt->execute();

                   
                    $logger->logger("TENTATIVA DE ACESSO",'Email : ' .$email .' Foi adicionado a lista de Bloqueados','warning');

                    $res = 1;
                    return $res ; 
                }else { 
                                    
                    $stmt=$db->prepare("select data from tentativa where emails = :email order by `data` desc limit 1;") ;
                    $stmt->bindValue(":email",$email);
                    $stmt->execute();
                
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $hr = $row['data'];    //retorna tempo de ultimo registro do usuario bloqueado 2024-03-22 08:44:59
                                
                    $ultimo_registro = new DateTime($hr);//convertendo hora do ultimo registro para Datetime 
                    $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo')); //data de agora 
                                      
                    $newdate_now = $datenow->format('Y-m-d H:i:s');
                    $newhr_bloq = $ultimo_registro->format('Y-m-d H:i:s');
                
                  
                        
                            if($newdate_now < $newhr_bloq )
                            {   //verificando se a data de agora é maior que a do ultimo registro no banco
                                
                                $addtime = date_add($ultimo_registro,date_interval_create_from_date_string('+10 minutes'));
                                $newtime = $addtime->format('Y-m-d H:i:s');
                            
                                $stmt=$db->prepare("update tentativa set data = :data where emails = :email ") ;
                                $stmt->bindValue(":email",$email);
                                $stmt->bindValue(":data",$newtime);
                                $stmt->execute();

                                $logger->logger("TENTATIVA DE ACESSO",'Email : ' .$email .' Foi adicionado uma penalidade de 10 minutos','warning');

                                $res = 2;
                                return $res ; 
                            }
                   
                    
                            $stmt=$db->prepare("delete from tentativa where emails = :email;") ;
                            $stmt->bindValue(":email",$email);
                            $stmt->execute();
                        
                
    } 
                }
        
    }
   
