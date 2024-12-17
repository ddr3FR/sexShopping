<?php 
    session_start();
    if ((!isset($_SESSION["cpf"])== true) and (!isset($_SESSION["senha"]) == true)){
        unset($_SESSION["cpf"]);
        unset($_SESSION["senha"]);
        header("Location: loginFuncio.php");
    }
    $logado = $_SESSION["cpf"] ;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema do Funcionario</title>
    <link rel="stylesheet" href="Style/style.css">
</head>

<body>
    <?php include 'navRpeSistemFuncio.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>