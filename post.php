<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    die('Você não está logado ');
}

include('nav4.php');
include('conexao.php');
include('nav2.php');





$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

if (isset($_FILES['file'])) {
    $arquivo = $_FILES['file'];

    if ($arquivo['error']) {
        die('Falha ao enviar o arquivo');
    }

    if ($arquivo['size'] > 2097152) {
        die("Tamanho de arquivo muito grande");
    }

    $pasta = "uploads/";

    $nomeA = $arquivo['name'];
    $novo = uniqid();
    $extensao = strtolower(pathinfo($nomeA, PATHINFO_EXTENSION));

    if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg") {
        echo ('Você está tentando enviar um arquivo que não é uma imagem');
        die('');

    }

    $path = $pasta . $novo . "." . $extensao;

    $caminho_completo = $path; // Caminho completo da imagem

    $enviado = move_uploaded_file($arquivo['tmp_name'], $caminho_completo);

    if ($enviado) {

        $idUsuario = $_SESSION['usuario'];

        $sqlvar = " SELECT img, nome FROM clientes WHERE id = $idUsuario ";
        $query2 = $mysqli->query($sqlvar);
        while ($row = $query2->fetch_assoc()) {

            $nome = $row['nome'];
            $img = $row['img'];

            echo $img, $nome;

        }



        // Inserir o post na tabela
        $query = "INSERT INTO post (nome_usuario, image_usuario, id_usuario, foto, path, descricao) VALUES ('$nome', '$img', '$idUsuario', '$nomeA', '$path', '$descricao')";

        if ($mysqli->query($query)) {
            // Obter o ID do post recém-inserido
            $ultimoIdInserido = $mysqli->insert_id;

            // Exibir o ID do post
            echo "ID do post recém-inserido: " . $ultimoIdInserido;


        }

        echo " <div class= \"center\" > <a target=\"_blank\" href='uploads/$novo.$extensao'>arquivo enviado Clique aqui para ver</a></div> ";
        echo " <div class= \"center\" > <a target=\"_blank\" href='dashboard.php'> Clique aqui para voltar ao dashboard</a></div> ";

    } else {
        echo "Falha ao enviar o arquivo";
    }

}


?>



<!DOCTYPE html>
<html>

<head>
    <style>
        .center {

            text-align: center;
            align-items: center;


        }

        .custom-file-input {
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

        .post {

            text-align: center;
            align-content: center;
            padding-top: 20rem;

        }

        .post #postar {

            padding: 1rem;
            border-radius: 1rem;
            outline: none;


        }


        .post #enviarbb {

            padding: 1rem;
            border-radius: 1rem;
            outline: none;
            border-color: aqua;
        }

        .post #postar:focus {


            border-color: aqua;

        }
    </style>
</head>

<body>
    <div class="post">
        <form action="" method="post" enctype="multipart/form-data">

            <input type="file" class="custom-file-input" id="inputGroupFile" aria-describedby="inputGroupFileAddon"
                accept="images/*" name="file">
            <label class="custom-file-label" for="inputGroupFile">Escolher arquivo</label>

            <br><br>
            <input type="text" name="descricao" required id="postar" placeholder="descrição">
            <br> <br>
            <button type="submit" id="enviarbb" class="btn btn-primary mt-3">Enviar post</button>


    </div>


    </form>



</body>

</html>