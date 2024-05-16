<?php
    session_start();

    $nomeAdm = $_SESSION['nome'];
    
    require_once "Sql.php";

    $db1 = new Sql();
    $stmt = $db1->query("SELECT * FROM estagiarios;");
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $resultado = json_encode($resultado);
    echo $resultado;
