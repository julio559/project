<?php
// Inclua seu arquivo de conexão com o banco de dados
include('conexao.php');

// Consulta SQL para contar o número de curtidas para cada post
$sql = "SELECT post_id, COUNT(*) AS total_likes FROM post_likes GROUP BY post_id";

$result = $mysqli->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $post_id = $row['post_id'];
        $total_likes = $row['total_likes'];

        // Atualize a tabela 'post' com o número de curtidas
        $update_sql = "UPDATE post SET like_count = ? WHERE id = ?";
        $stmt = $mysqli->prepare($update_sql);
        $stmt->bind_param("ii", $total_likes, $post_id);
        $stmt->execute();
    }
    $result->close();
}

$mysqli->close();


exit;
?>
