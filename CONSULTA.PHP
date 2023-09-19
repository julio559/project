<?php
include('conexao.php');


$sql = " SELECT nome FROM clientes WHERE id = 3 ";
$sql_exec = $mysqli->query($sql);
while ($row = $sql_exec->fetch_assoc()) {

    $nome = $row['nome'];
    echo $nome;
}

//ou cria uma variavel  para identificar o id  por ex
//porem exite o metodo de puxar o id pelo get ou post



$id = isset($_POST['id']);
$id = isset($_GET['id']);
$id = 3;


?>