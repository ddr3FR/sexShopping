<?php
session_start();

if (isset($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];
    
    if (isset($_SESSION['carrinho'][$produto_id])) {
        unset($_SESSION['carrinho'][$produto_id]);
    }
}

header("Location: carrinho.php");
exit;
?>