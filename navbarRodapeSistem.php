<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar e rodapé</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Prazeres do Norte</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Qual o seu desejo?" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">🔍</button>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Opções Quentes 🔥🥵😈</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Carrinho</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sair.php">Sair</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </nav>

</body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>