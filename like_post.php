<?php

session_start();

include('conexao.php'); 
include('dashboard.php');

if (isset($_POST['action']) && $_POST['action'] === 'like' && isset($_POST['post_id'])) {
    // Conectar ao banco de dados
    $mysqli = new mysqli('localhost', 'root', '', 'loja'); // Atualize com suas credenciais de banco de dados

    // Verificar erros de conexão com o banco de dados
    if ($mysqli->connect_error) {
        die('Erro na conexão com o banco de dados: ' . $mysqli->connect_error);
    }

    // Sanitizar e obter o post_id dos dados POST
    $post_id = $mysqli->real_escape_string($_POST['post_id']);
    
    // Substitua isso pela lógica para obter o ID do usuário a partir da sessão
   
        $user = $id;
    
      
   

 
    $insert_query = "INSERT INTO post_likes (post_id, user_id) VALUES (?, ?)";
    
    $stmt = $mysqli->prepare($insert_query);
    if ($stmt) {
        $stmt->bind_param('ii', $post_id, $user);
        
        if ($stmt->execute()) {
    
            $response = ['success' => true, 'new_like_count' => getLikeCount($mysqli, $post_id)];
        } else {
      
            $response = ['success' => false, 'message' => 'Erro ao atualizar a contagem de likes'];
        }
        
        $stmt->close();
    } else {
  
        $response = ['success' => false, 'message' => 'Erro ao preparar a consulta'];
    }

 
    $mysqli->close();
} else {
    $response = ['success' => false, 'message' => 'Requisição inválida'];
}


function getLikeCount($mysqli, $post_id) {
    $select_query = "SELECT COUNT(*) AS like_count FROM post_likes WHERE post_id = ?";
    
    $stmt = $mysqli->prepare($select_query);
    if ($stmt) {
        $stmt->bind_param('i', $post_id);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['like_count'];
        }
    }
    
    return 0;
}

// Retornar a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
