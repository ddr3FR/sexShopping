<?php
session_start();
include_once('config.php');

if (isset($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];

    $stmt = $db->prepare("SELECT id, nome, preco FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $produto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    if ($produto) {

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        if (isset($_SESSION['carrinho'][$produto_id])) {
            $_SESSION['carrinho'][$produto_id]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$produto_id] = [
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => 1
            ];
        }
    }

    header("Location: carrinho.php");
    exit;
}
?>