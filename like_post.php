<?php
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'like') {
    // Inclua seu arquivo de conexão com o banco de dados aqui
    include('conexao.php');

    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['usuario']; // Supondo que você tenha uma sessão de usuário
    
    // Verifique se o usuário já curtiu o post (você pode usar SQL para fazer isso)
    $check_like_sql = "SELECT id FROM post_likes WHERE post_id = ? AND user_id = ?";
    $stmt = $mysqli->prepare($check_like_sql);
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        // O usuário ainda não curtiu o post, então insira o like
        $insert_like_sql = "INSERT INTO post_likes (post_id, user_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($insert_like_sql);
        $stmt->bind_param("ii", $post_id, $user_id);
        $stmt->execute();
        
        // Você pode retornar uma resposta ao cliente para indicar o sucesso
        echo json_encode(['success' => true]);
        exit;
    } else {
        // O usuário já curtiu o post
        echo json_encode(['success' => false, 'message' => 'Você já curtiu este post.']);
        exit;
    }
}
?>