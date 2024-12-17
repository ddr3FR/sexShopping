<?php
session_start();
include_once('config.php'); 

$query = "SELECT * FROM funcionarios";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navRpeSistemFuncio.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Funcionario</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Salario</th>
                        <th>Email</th>
                        <th>Data Nascimento</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['cargo']) . "</td>";
                            echo "<td>" . number_format($row['salario'], 2, ',', '.') . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . $row['data_nascimento'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";


                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Erro.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="cadastroFuncio.php" class="btn btn-primary">Cadastrar Funcionario</a>
            <a href="sistemaFuncionario.php" class="btn btn-secondary">Voltar ao Início</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>