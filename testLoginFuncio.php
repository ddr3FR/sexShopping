<?php 
    session_start();
    if (isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['senha'])) {
        include_once('config.php');
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
    
        $stmt = $db->prepare("SELECT * FROM funcionarios WHERE cpf = ?");
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $result = $stmt->get_result();
        print_r($result);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc(); 

            if (password_verify($senha, $user['senha'])) {
                echo "<script>
                        alert('Login realizado com sucesso!');
                        window.location.href = 'sistemaFuncionario.php';
                      </script>";
                $_SESSION['cpf'] = $cpf;
                $_SESSION['senha'] = $senha;
                header('Location: sistemaFuncionario.php');
            } else {
                echo "<script>
                        alert('Senha incorreta. Tente novamente.');
                        window.location.href = 'loginFuncio.php';
                      </script>";
            }
        } else {
            unset($_SESSION["cpf"]);
            unset($_SESSION["senha"]);
            echo "<script>
                    alert('CPF não encontrado. Verifique e tente novamente.');
                    window.location.href = 'loginFuncio.php';
                  </script>";   
        }
    
        $stmt->close();
    } else {
        header('Location: loginFuncio.php');
        exit;
    }
?>