<?php
include('conexao.php');

$sql = "SELECT path, descricao FROM post ORDER BY RAND()";
$result = $mysqli->query($sql);

if ($result) {
    echo "Número de linhas retornadas: " . $result->num_rows;
    
    while ($row = $result->fetch_assoc()) {
        $pathAleatorio = $row['path'];
        $nomeAleatorio = $row['descricao'];
        
        echo "Caminho Aleatório: " . " <img class='tamanho' src='$pathAleatorio'>  <p> $nomeAleatorio </p>  ";
    }
    
    $result->close();
} else {
    echo "Erro na consulta: " . $mysqli->error;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style> 
.tamanho{

width: 150px;


}

