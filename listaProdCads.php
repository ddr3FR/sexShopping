<?php
include_once('config.php'); 

$query = "SELECT * FROM produtos";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navRpeSistemFuncio.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Produtos</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço (R$)</th>
                        <th>Quantidade em Estoque</th>
                        <th>Categoria</th>
                        <th>Data Adicionado</th>
                        <th>Data Atualizada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
                            echo "<td>" . number_format($row['preco'], 2, ',', '.') . "</td>";
                            echo "<td>" . $row['quantidade_estoque'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                            echo "<td>" . $row['data_adicionado'] . "</td>";

                            // Verifique se a chave 'data_atualizada' existe antes de acessar
                            echo "<td>" . (isset($row['data_atualizada']) ? $row['data_atualizada'] : 'Não atualizada') . "</td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Nenhum produto encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="cadastProd.php" class="btn btn-primary">Cadastrar Novo Produto</a>
            <a href="#" class="btn btn-secondary">Voltar ao Início</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>