<?php
if (isset($_POST["submit"])) {
    include_once('config.php');

    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];

    // Criptografar a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Verificar se o CPF já está cadastrado
    $cpf_check_stmt = $db->prepare("SELECT cpf FROM funcionarios WHERE cpf = ?");
    $cpf_check_stmt->bind_param("s", $cpf);
    $cpf_check_stmt->execute();
    $cpf_check_stmt->store_result();

    if ($cpf_check_stmt->num_rows > 0) {
        echo "<script>
                alert('CPF já cadastrado! Por favor, use outro CPF.');
                window.location.href = 'cadastroFuncionario.php';
              </script>";
    } else {
        // Inserir dados no banco
        $stmt = $db->prepare("INSERT INTO funcionarios (cpf, senha, nome, cargo, salario, email, data_nascimento, telefone) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $cpf, $senha_criptografada, $nome, $cargo, $salario, $email, $data_nascimento, $telefone);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Funcionário cadastrado com sucesso!');
                    window.location.href = 'listaFuncionarios.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao cadastrar funcionário. Tente novamente.');
                  </script>";
        }
        $stmt->close();
    }

    $cpf_check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navRpeSistemFuncio.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Cadastro de Funcionários</h2>
        <form action="cadastroFuncio.php" method="POST" class="mt-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-md-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" pattern="\d{11}"
                        title="Insira um CPF válido (11 dígitos)" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cargo" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="cargo" name="cargo" required>
                </div>
                <div class="col-md-6">
                    <label for="salario" class="form-label">Salário</label>
                    <input type="number" class="form-control" id="salario" name="salario" step="0.01" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" pattern="\d+"
                        title="Apenas números" required>
                </div>
                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Cadastrar Funcionário</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>