<?php 
    session_start();
    if ((!isset($_SESSION["cpf"])== true) and (!isset($_SESSION["senha"]) == true)){
        unset($_SESSION["cpf"]);
        unset($_SESSION["senha"]);
        header("Location: login.php");
    }
    $logado = $_SESSION["cpf"] ;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="Style/style.css">
</head>

<body>
    <?php include 'navbarRodapeSistem.php'; ?>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="img/publi2.avif" class="d-block w-100" alt="Imagem 1">
            </div>

            <div class="carousel-item">
                <img src="img/publi.jpg" class="d-block w-100" alt="Imagem 2">
            </div>

            <div class="carousel-item">
                <img src="img/lub.webp" class="d-block w-100" alt="Imagem 3">
            </div>
        </div>


        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>