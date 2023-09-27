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

$sql = "SELECT nome, img FROM clientes WHERE id = $id";
$quert = $mysqli -> query($sql);
while( $roww = $quert -> fetch_assoc() ){

$nome = $roww['nome'];
$img = $roww['img'];
}


$sql3 = "SELECT foto, path, descricao, nome_usuario FROM post WHERE id_usuario = $id";
$query = $mysqli->query($sql3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo $nome; ?></title>

    <style>
     body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .profile-header {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.2);
        }

        .profile-info {
            margin-left: 20px;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
        }

        h1 {
            font-size: 28px;
            margin: 0;
            color: #333;
        }

        .postagens {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .post {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .post:hover {
            transform: scale(1.02);
        }

        .post-image {
            max-width: 100%;
            height: auto;
            display: block;
        }

       
        .post-description {
            padding: 15px;
            font-size: 16px;
            color: #333;
        }
        
     
        .post-content {
            padding: 15px;
        }
    </style>

</head>

<body>
    <div class="profile-header">
        <div class="profile-info">
            <img src="<?php echo $img; ?>" alt="" class="profile-picture">
            <h1><?php echo $nome; ?></h1>
        </div>
    </div>

    <div class="postagens">
        <?php
        while ($row = $query->fetch_assoc()) {
            $foto = $row['foto'];
            $path = $row['path'];
            $descricao = $row['descricao'];
            $nome_usuario = $row['nome_usuario'];

       
            echo "<div class='post'>";
            echo "<img src='$path' alt='$descricao' class='post-image' height = '100px'>";
            echo "<div class='post-description'>$descricao</div>";
            echo "</div>";
        }
        ?>
    </div>

</body>

</html>