<?php
include_once('config.php');
session_start();

if (!isset($_GET['produto_id'])) {
    echo "<h3 class='text-center'>Produto não especificado!</h3>";
    exit;
}

$produto_id = intval($_GET['produto_id']); 
$stmt = $db->prepare("SELECT id, nome, descricao, preco, quantidade_estoque FROM produtos WHERE id = ?");
$stmt->bind_param("i", $produto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h3 class='text-center'>Produto não encontrado!</h3>";
    exit;
}

$produto = $result->fetch_assoc(); 
$preco = number_format($produto['preco'], 2, ',', '.');
$estoque = $produto['quantidade_estoque'];


if (isset($_POST['adicionar_carrinho'])) {
    $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;

    
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id]['quantidade'] += $quantidade;
    } else {
        $_SESSION['carrinho'][$produto_id] = [
            'id' => $produto_id,
            'nome' => $produto['nome'],
            'preco' => $produto['preco'],
            'quantidade' => $quantidade
        ];
    }

    header("Location: carrinho.php");
    exit;
}


if (isset($_POST['comprar_direto'])) {
    $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;

    if ($quantidade > $estoque) {
        echo "<h3 class='text-center text-danger'>Quantidade solicitada excede o estoque disponível!</h3>";
    } else {
        echo "<h3 class='text-center text-success'>Compra realizada com sucesso!</h3>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'navbarRodape.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="images/produto.jpg" class="img-fluid" alt="Imagem do produto">
            </div>
            <div class="col-md-6">
                <h2><?= htmlspecialchars($produto['nome']); ?></h2>
                <p><?= htmlspecialchars($produto['descricao']); ?></p>
                <p><strong>Preço:</strong> R$ <?= $preco; ?></p>
                <p><strong>Estoque disponível:</strong> <?= $estoque; ?> unidades</p>

                <form method="POST">
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="1" min="1"
                            max="<?= $estoque; ?>">
                    </div>
                    <button type="submit" name="adicionar_carrinho" class="btn btn-primary">Adicionar ao
                        Carrinho</button>
                    <button type="submit" name="comprar_direto" class="btn btn-success">Comprar Agora</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>