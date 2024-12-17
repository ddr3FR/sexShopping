<?php
if (isset($_POST["submit"])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['estado'];
    $cep = $_POST['cep'];
    $idade = $_POST['idade'];
    $senha = $_POST['senha'];

    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    
    $cpf_check_stmt = $db->prepare("SELECT cpf FROM clientes WHERE cpf = ?");
    $cpf_check_stmt->bind_param("s", $cpf);
    $cpf_check_stmt->execute();
    $cpf_check_stmt->store_result();

    if ($cpf_check_stmt->num_rows > 0) {

        echo "<script>
                alert('CPF já cadastrado! Por favor, use outro CPF.');
                window.location.href = 'cadastro.php';
              </script>";
    } else {
        
        $stmt = $db->prepare("INSERT INTO clientes(nome, cpf, telefone, email, endereco_rua, endereco_numero, endereco_complemento, endereco_bairro, endereco_cidade, endereco_estado, endereco_cep, idade, senha) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $nome, $cpf, $telefone, $email, $rua, $numero, $complemento, $bairro, $cidade, $uf, $cep, $idade, $senha_criptografada);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Cadastro realizado com sucesso!');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao cadastrar. Tente novamente.');
                  </script>";
        }
        $stmt->close();
    }

    $cpf_check_stmt->close();
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="Style/style.css">
</head>

<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <?php include 'navbarRodape.php'; ?>

    <div class="container">
        <h1>Cadastro de Cliente - Sex Shop</h1>

        <div class="form-container">
            <form action="cadastro.php" method="POST">

                <div class="row">
                    <div class="col-md-6 form-row">
                        <label for="nome">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="col-md-6 form-row">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" required>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 form-row">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" required>
                    </div>
                    <div class="col-md-6 form-row">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 form-row">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" required>
                    </div>
                    <div class="col-md-6 form-row">
                        <label for="numero">Número da Casa/Apartamento</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 form-row">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento">
                    </div>
                    <div class="col-md-6 form-row">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-row">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                    <div class="col-md-6 form-row">
                        <label for="estado">Estado (UF)</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="" disabled selected>Selecione o Estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 form-row">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" maxlength="8" required>
                    </div>
                    <div class="col-md-6 form-row">
                        <label for="idade">Idade</label>
                        <input type="number" class="form-control" id="idade" name="idade" required min="18">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-row">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="col-md-6 form-row">
                        <label for="confirmar_senha">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-row">
                        <button type="submit" class="btn-primary" id="submit" name="submit">Cadastrar</button>
                    </div>
                    <div class="col-md-6 form-row">
                        <p>Já tem <a href="login.php"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Login</a>?
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function validarIdade() {
        var idade = document.getElementById('idade').value;
        if (idade < 18) {
            alert("Você precisa ter 18 anos ou mais para se cadastrar.");
            return false;
        }
        return true;
    }

    // const form = document.getElementById('cadastroForm');
    // form.addEventListener('submit', function(event) {
    //     const senha = document.getElementById('senha').value;
    //     const confirmarSenha = document.getElementById('confirmar_senha').value;

    //     if (senha !== confirmarSenha) {
    //         event.preventDefault();
    //         alert("As senhas não coincidem. Por favor, verifique.");
    //     }
    // });
    </script>
</body>

</html>