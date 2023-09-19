<?php
session_start();



if (!isset($_SESSION['usuario'])) {
    die('Usuário não está logado.');
}



include('conexao.php'); 

$postId = $_POST['postId'];
$userId = $_SESSION['usuario'];

$checkQuery = "SELECT id FROM likes WHERE id_usuario = ? AND id_post = ?";
$stmt = $mysqli->prepare($checkQuery);
$stmt->bind_param('ii', $userId, $postId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   
    echo 'liked';
} else {

    $insertQuery = "INSERT INTO likes (id_usuario, id_post) VALUES (?, ?)";
    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param('ii', $userId, $postId);
    $stmt->execute();
    echo 'not_liked';
}
?>
