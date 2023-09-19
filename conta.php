<?php   
include('conexao.php');
include('nav4.php');
include('buscar.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    echo "Você não está logado";
    header("location: index.php");
    die("Você não está logado");
}

// Agora você pode acessar a variável $_SESSION['usuario'] nesta página
$usuarioID = $_SESSION['usuario'];

$sql_clientes = "SELECT nome, numero, dat, email, id FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die;
$sql_id = "SELECT id, nome FROM clientes"; 
$query_nome = $mysqli->query($sql_id) or die; 
?>