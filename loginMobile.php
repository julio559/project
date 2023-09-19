<?php
include('conexao.php');


if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['enviar'])) {
    
    $email = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    $nome = "SELECT nome FROM clientes WHERE email = '$email' LIMIT 1";
    $sql_run = $mysqli->query($nome);
    $sql_code = "SELECT * FROM clientes WHERE email = '$email' LIMIT 1";
    $sql_exec = $mysqli->query($sql_code);

    if ($sql_run && $sql_run->num_rows > 0) {
        $usuario = $sql_run->fetch_assoc();
    }

    if ($sql_exec && $sql_exec->num_rows > 0) {
        $usuario = $sql_exec->fetch_assoc();
     
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['id'];
            header("Location: dashboard.php?nome=" . urlencode($usuario['nome']));
            exit;
        } else {
            echo 'Email ou senha não encontrado';
        }
    } else {
        echo 'Email ou senha não encontrado';
    }
}


if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit; 
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(dono-do-animal-de-estimacao-voltando-para-casa-abrindo-a-porta-o-cao-que-encontra-a-mulher-que-retorna-na-casa-entra-cachorrinho-cumprimentando-pessoa-sentado-no-tapete-de-entrada-estilo-de-vida-solo-ilustracao-veto.avif);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px #000;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: rgb(212, 122, 97);
            text-transform: uppercase;
            font-weight: bold;
           
        }

        .email {
            margin-bottom: 1rem;
        }

        .input-group {
            position: relative;
        }

        .input-group-append {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        .ola {
            border-radius: 1rem;
            padding: 0.3rem 1rem;
            border-color: purple;
            font-size: 18px;
            color: white;
            background-color: rgb(212, 122, 97);
            text-align: center;
            display: block;
            width: 100%;
            margin-top: 1rem;
        }

        .ola:hover {
            background-color: rgb(172, 82, 57);
            transition: 1s;
        }

        a {
            font-size: 18px;
            color: aqua;
            outline: none;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <h1> <img src="download.jpeg" class="imagem2"> Login </h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control email" id="email" name="usuario" placeholder="Insira o email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <div class="input-group">
                    <input type="password" id="password" name="senha" placeholder="Digite sua senha" class="form-control" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-light" id="toggle">
                            <i id="toggleIcon" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <input type="submit" name="enviar" class="ola" value="Entrar" id="entrar">
            <a href="criar.php">Criar conta</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const passwordInput = document.getElementById("password");
        const toggleButton = document.getElementById("toggle");
        const toggleIcon = document.getElementById("toggleIcon");

        toggleButton.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.className = "fas fa-eye";
            } else {
                passwordInput.type = "password";
                toggleIcon.className = "fas fa-eye-slash";
            }
        });
    </script>
</body>
</html>



