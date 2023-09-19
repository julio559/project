<?php 
include('conexao.php');

if (isset($_POST['ola'])) {
    $nome = $_POST['ola'];  
    
    $pesquisar = "SELECT nome FROM clientes WHERE nome LIKE ?";
    
    $stmt = $mysqli->prepare($pesquisar);
    
    $param = "%$nome%";
    
    $stmt->bind_param("s", $param);
    
    $stmt->execute();
    
    $result = $stmt->get_result();
}

$sql_busca = "SELECT nome, email FROM clientes";
$sql_query = $mysqli->query($sql_busca);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da pesquisa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .perfil {
            background-color: #fff;
            padding: 17px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 15px;
            max-width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .ola {
            text-align: center;
        }

        .perfil p {
            margin: 0;
        }

        .right {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="right">
        <div class="ola">
            <?php
            if (isset($result)) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="perfil">';
                    echo '<p>' . $row['nome'] . '</p>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>






