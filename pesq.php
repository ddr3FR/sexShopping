<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Produtos - SexShopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/style2.css">

</head>

<body>
    <?php include 'navbarRodape.php'; ?>
    <div class="search-container text-center">
        <h2>Resultados da Pesquisa</h2>
    </div>

    <div class="container">
        <div class="row">

            <?php
            include_once('config.php');

            if (isset($_POST['pesquisa'])) {
                $termo = $_POST['pesquisa'];
                $stmt = $db->prepare("SELECT id, nome, descricao, preco, quantidade_estoque FROM produtos WHERE nome LIKE ?");
                $pesquisa = "%" . $termo . "%";  
                $stmt->bind_param("s", $pesquisa);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $preco = number_format($row['preco'], 2, ',', '.');
                        $estoque = $row['quantidade_estoque'];
                        echo "
                            <div class='col-md-4 mb-4'>
                                <div class='card'>
                                    <img src='images/produto.jpg' class='card-img-top' alt='Imagem do produto'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>" . htmlspecialchars($row['nome']) . "</h5>
                                        <p class='card-text'>" . htmlspecialchars($row['descricao']) . "</p>
                                        <p class='card-text'><strong>Preço:</strong> R$ $preco</p>
                                        <p class='card-text'><strong>Estoque:</strong> $estoque unidades</p>
                                        <a href='addcarrinho.php?produto_id=" . $row['id'] . "' class='btn btn-primary'>Adicionar ao Carrinho</a>
                                        <a href='carrinho.php?produto_id=" . $row['id'] . "' class='btn btn-success'>Comprar Agora</a>
                                    </div>
                                </div>
                            </div>
                        " ; } } else { echo "<h3 class='text-center'>Nenhum produto encontrado para: <em>" .
                htmlspecialchars($termo) . "</em></h3>" ; } $stmt->close();
                }
                ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>