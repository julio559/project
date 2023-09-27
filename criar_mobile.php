<?php
include ('conexao.php');
include ('insertc_client.php');

$senha = isset(  $_POST['senha']);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        
        // Perform a SELECT query to retrieve data based on email
        $sql_code = "SELECT * FROM clientes WHERE email = '$email'";
        $result = $mysqli->query($sql_code);

        if ($result) {
            $row = $result->fetch_assoc();


            if ($row) {
                // Fetch other data from the row if needed
                $nome = $row['nome'];
                $numero = $row['numero'];
                $data = $row['data'];
            } else {
                echo "Nenhum registro encontrado para o email informado.";
            }
        } else {
            echo "Erro ao buscar dados: " . $mysqli->error;
        }
    }
}


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@200&family=Open+Sans:wght@300&family=Playfair+Display:ital,wght@1,500&family=Roboto+Mono:ital,wght@1,500&family=Roboto:wght@100&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .image-left img {
            max-width: 100%;
            height: auto;
        }

        .direita {
            margin-top: 20px;
        }

        .direita input[type="file"] {
            display: none;
        }

        .custom-file-label {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-file-label:hover {
            background-color: #2980b9;
        }

        .direita input[type="email"],
        .direita input[type="text"],
        .direita input[type="number"],
        .direita input[type="date"],
        .direita input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .direita button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .direita button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 image-left">
                <img src="pessoa-e-animal-de-estimacao-personagem-de-dono-de-animal-de-estimacao-homem-segurando-nas-maos-de-seu-cachorro-o-homem-ama-seu-animal-animal-domestico-fofo-e-adoravel_93083-590.avif" alt="Imagem de perfil">
            </div>
            <div class="col-md-6 direita">
                <h1>Criar Conta</h1>
                <form action="insertc_client.php" method="post" enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="selectedImage" required>
                        <label class="custom-file-label" for="selectedImage">Escolha sua foto de perfil</label>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <input type="text" name="nome" class="form-control" placeholder="Nome de Usuário" required>
                    <input type="number" name="numero" class="form-control" placeholder="Número de Telefone" required>
                    <input type="date" name="data" class="form-control" placeholder="Data" required>
                    <div class="input-group">
                        <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="toggle">
                                <i id="toggleIcon" class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="lembrar"></div>
                    <button type="submit" class="btn btn-primary btn-block">Enviar Dados</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script>
        const passwordInput = document.getElementById("senha");
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

        const fileInput = document.getElementById('selectedImage');
        const selectedImage = document.querySelector('.image-left img');

        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];

            if (file) {
                const imageUrl = URL.createObjectURL(file);
                selectedImage.src = imageUrl;
            } else {
                selectedImage.src = '';
            }
        });
    </script>
</body>
</html>
