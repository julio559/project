<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
    die("Você não está logado");
}
include('conexao.php');
include('nav4.php');
include('nav2.php');


$id = $_GET['id'];


$sql = " SELECT nome, img FROM clientes WHERE id = $id ";
$sql2 = $mysqli->query($sql);
while ($row = $sql2->fetch_assoc()) {

    $nome = $row['nome'];
    $img = $row['img'];



}

$sql3 = "SELECT foto, path, descricao, nome_usuario FROM post WHERE id_usuario = $id";
$quey = $mysqli -> query($sql3);
while( $row = $quey -> fetch_assoc() ){

$n = $row['nome_usuario'];
$f = $row['foto'];
$p = $row['path'];
echo $f;


}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style3.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perfil
        <?php $nome; ?>
    </title>
</head>

<body>

    <div class="info">
        <div class="div">
            <p class="nome">
                <?php echo $nome ?>
            </p>
        </div>
        <img src="<?php echo $img ?>" alt="" class="red" srcset="" width="100px" height="100px">



    </div>


</body>

</html>