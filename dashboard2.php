<?php 

$duracao = time() + (30 * 24 * 60 * 60);
if (isset($_GET['img'])) {

    $image = $_GET['img'];
    if (setcookie("image", $_GET['img'], $duracao))
        ;




}



if (isset($_GET['id'])) {

    $id = $_GET['id'];
    if (setcookie("id", $_GET['id'], $duracao))
        ;}

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];

    if (setcookie("salvar", $_GET['nome'], $duracao));



}

header('location: dashboard.php');

?>