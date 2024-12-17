<?php

$dbHost = 'localhost'; 
$dbName = 'sexshopping'; 
$dbUser = 'root'; 
$dbPassword = ''; 

try {
    
    $db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($db->connect_error) {
        throw new Exception("Falha na conexão com o banco de dados: " . $db->connect_error);
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>