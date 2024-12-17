<?php
session_start();
if (isset($_POST["submit"])) {
    include_once('config.php'); 

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $categoria = $_POST['categoria'];
    $data_adicionado = date('Y-m-d'); 
    $data_atualizada = date('Y-m-d');

    $produto_check_stmt = $db->prepare("SELECT id FROM produtos WHERE nome = ?");
    $produto_check_stmt->bind_param("s", $nome);
    $produto_check_stmt->execute();
    $produto_check_stmt->store_result();

    if ($produto_check_stmt->num_rows > 0) {
        echo "<script>
                alert('Produto com este nome já está cadastrado! Por favor, escolha outro nome.');
                window.location.href = 'cadastProd.php';
              </script>";
    } else {
        
        $stmt = $db->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade_estoque, categoria, data_adicionado, data_atualizada) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdisss", $nome, $descricao, $preco, $quantidade_estoque, $categoria, $data_adicionado, $data_atualizada);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Produto cadastrado com sucesso!');
                    window.location.href = 'listaProdCads.php'; 
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao cadastrar o produto. Tente novamente.');
                    window.location.href = 'cadastProd.php';
                  </script>";
        }
        $stmt->close(); 
    }

    $produto_check_stmt->close(); 
    header("Location: listaProdCads.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>

<body>
    <?php include 'navRpeSistemFuncio.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cadastro de Produtos</h1>
        <form action="cadastProd.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="quantidade_estoque" class="form-label">Quantidade em Estoque</label>
                <input type="number" class="form-control" id="quantidade_estoque" name="quantidade_estoque" required>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="" selected disabled>Selecione a categoria</option>
                    <option value="Brinquedos">Brinquedos</option>
                    <option value="Lubrificantes">Lubrificantes</option>
                    <option value="Roupas">Roupas</option>
                    <option value="Cosméticos">Cosméticos</option>
                    <option value="Acessórios">Acessórios</option>
                    <option value="Preservativos">Preservativos</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="data_adicionado" class="form-label">Data Adicionado</label>
                <input type="date" class="form-control" id="data_adicionado" name="data_adicionado" required>
            </div>

            <div class="mb-3">
                <label for="data_atualizada" class="form-label">Data Atualizada</label>
                <input type="date" class="form-control" id="data_atualizada" name="data_atualizada" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">Cadastrar Produto</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>