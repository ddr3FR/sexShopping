<?php
session_start();
$frete = 0; // Inicializa o valor do frete como 0
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cep'])) {
    $cep = preg_replace('/[^0-9]/', '', $_POST['cep']); // Limpa o CEP para apenas números
    if (strlen($cep) === 8) {
        // Faz a chamada à API ViaCEP
        $viaCepUrl = "https://viacep.com.br/ws/$cep/json/";
        $response = file_get_contents($viaCepUrl);
        $endereco = json_decode($response, true);

        if (isset($endereco['erro'])) {
            $mensagem = "CEP inválido ou não encontrado.";
        } else {
            // Calcula o frete com base no estado (exemplo fictício)
            $estado = $endereco['uf'];
            if (in_array($estado, ['SP', 'RJ', 'MG', 'ES'])) {
                $frete = 20; // Sudeste
            } elseif (in_array($estado, ['PR', 'SC', 'RS'])) {
                $frete = 25; // Sul
            } elseif (in_array($estado, ['AC', 'AP', 'AM', 'PA', 'RO', 'RR', 'TO'])) {
                $frete = 50; //Remo Maior do norte
            } 
            else {
                $frete = 30; // Demais estados
            }
        }
    } else {
        $mensagem = "CEP inválido. Por favor, insira um CEP válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbarRodape.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Carrinho de Compras</h2>

        <?php if (!empty($_SESSION['carrinho'])): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    foreach ($_SESSION['carrinho'] as $id => $item):
                        $subtotal = $item['preco'] * $item['quantidade'];
                        $total += $subtotal;
                    ?>
                <tr>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                    <td>
                        <a href="remover.php?produto_id=<?= $id ?>" class="btn btn-danger btn-sm">Remover</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total dos Produtos:</strong></td>
                    <td colspan="2">R$ <?= number_format($total, 2, ',', '.') ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end"><strong>Frete:</strong></td>
                    <td colspan="2">R$ <?= number_format($frete, 2, ',', '.') ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total Geral:</strong></td>
                    <td colspan="2">R$ <?= number_format($total + $frete, 2, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="my-4">
            <form method="POST" action="">
                <label for="cep" class="form-label">Calcular Frete</label>
                <div class="input-group">
                    <input type="text" name="cep" id="cep" class="form-control" placeholder="Digite seu CEP" required>
                    <button type="submit" class="btn btn-primary">Calcular</button>
                </div>
            </form>
            <?php if (isset($mensagem)): ?>
            <p class="text-danger mt-2"><?= htmlspecialchars($mensagem) ?></p>
            <?php endif; ?>
        </div>

        <div class="d-flex justify-content-end">
            <a href="checkout.php" class="btn btn-success me-2">Finalizar Compra</a>
            <a href="index.php" class="btn btn-primary">Continuar Comprando</a>
        </div>
        <?php else: ?>
        <p class="text-center">Seu carrinho está vazio.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>