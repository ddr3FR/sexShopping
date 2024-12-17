<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>login Funcionario</title>
</head>

<body class="bg-dark text-light">
    <?php include 'navbarRodape.php'; ?>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px; border-radius: 10px;">
            <h2 class="text-center mb-4">Login Funcionario</h2>
            <form action="testLoginFuncio.php" method="POST">

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="Digite seu CPF"
                        maxlength="11" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha"
                        required>
                </div>

                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-primary">Acessar Conta</button>
                </div>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>