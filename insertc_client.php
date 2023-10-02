<?php
include('conexao.php');
$erro = false;

if (count($_POST) > 0) {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $data = $_POST['data'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

if ( $senha > 8 || $senha < 20  ){


}else{

echo "a senha tem que ser maior que 8 e menor que 20 caracteres";
die();

}

    if (isset($_FILES['file'])) {
        $arquivo = $_FILES['file'];

        if ($arquivo['error']) {
            $erro = 'Falha ao enviar o arquivo';
        }

        if ($arquivo['size'] > 2097152) {
            $erro = 'Tamanho de arquivo muito grande';
        }

        $pasta = "uploads/";

        $nomeA = $arquivo['name'];
        $novo = uniqid();
        $extensao = strtolower(pathinfo($nomeA, PATHINFO_EXTENSION));

        if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg") {
            $erro = 'Você está tentando enviar um arquivo que não é uma imagem';
        }

        $path = $pasta . $novo . "." . $extensao;
        $caminho_completo = $path;

        $enviado = move_uploaded_file($arquivo['tmp_name'], $caminho_completo);
    }

    if (empty($nome)) {
        $erro = 'Preencha o nome';
    }
    if (empty($numero)) {
        $erro = 'Preencha o numero';
    }
    if (empty($email)) {
        $erro = 'Preencha o email';
    }

    if (empty($data)) {
        $erro = 'Preencha a data';
    }
    if (empty($senha)) {
        $erro = 'Preencha a senha';
    }

    if (!$erro) {
        $pedacos = explode("/", $data);
        $data = implode("-", array_reverse($pedacos));

        if ($mysqli->connect_errno) {
            echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        } else {
            $checkEmailQuery = "SELECT COUNT(*) FROM clientes WHERE email = ?";
            $stmtCheckEmail = $mysqli->prepare($checkEmailQuery);
            $stmtCheckEmail->bind_param("s", $email);
            $stmtCheckEmail->execute();
            $stmtCheckEmail->bind_result($emailCount);
            $stmtCheckEmail->fetch();
            $stmtCheckEmail->close();

            if ($emailCount > 0) {
                echo  '<br>',  ' <div class="belau"> <div class="afastar"> <a href=" criar.php " class="pensar" >  O email já está cadastrado <br> clique aqui para voltar  a criar a conta</a> </div></div> ';
            } else {
                $checkNomeQuery = "SELECT COUNT(*) FROM clientes WHERE nome = ?";
                $stmtCheckNome = $mysqli->prepare($checkNomeQuery);
                $stmtCheckNome->bind_param("s", $nome);
                $stmtCheckNome->execute();
                $stmtCheckNome->bind_result($nomeCount);
                $stmtCheckNome->fetch();
                $stmtCheckNome->close();

                if ($nomeCount > 0) {
                    echo  '<br>',  ' <div class="belau"> <div class="afastar"> <a href=" criar.php " class="pensar" >  O nome já está cadastrado <br> clique aqui para voltar  a criar a conta</a> </div></div> ';
                } else {
                
                    $sql_code = "INSERT INTO clientes (img, nome, email, numero, dat, senha) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $mysqli->prepare($sql_code);
                    $stmt->bind_param("ssssss", $path, $nome, $email, $numero, $data, $senha);

                    if ($stmt->execute()) {
                        echo "Dados inseridos com sucesso!";
                        header('location: index.php');
                    } else {
                        echo "Erro ao inserir dados: " . $stmt->error;
                    }
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
<style> 

.belau{
padding-right: 34rem;
    padding-left: 43rem;
padding-top: 20rem;
font-size: 20px;
font-family: sans-serif;

}
.afastar{

border: solid 1px orange;


}

.pensar{

display: flex;
text-align: center;

padding-left: 6rem;

}

</style>



</head>
<body>
    



</body>
</html> 
