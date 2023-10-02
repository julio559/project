<?php 
include('conexao.php');
$duracao = time() + (30 * 24 * 60 * 60);




if (isset($_GET['id'])) {

    $id = $_GET['id'];
    if (setcookie("id", $_GET['id'], $duracao))
        ;}

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];

    if (setcookie("salvar", $_GET['nome'], $duracao));



}

$sql = "SELECT img FROM clientes WHERE nome = '$nome'";
$quert = $mysqli -> query($sql);
while($row = $quert -> fetch_assoc()){

$img = $row['img'];

}

if (isset($img)) {

   
   setcookie("image", $img, $duracao);
     




}

header('location: dashboard.php');
       
?>