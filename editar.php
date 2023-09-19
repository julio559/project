
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <title>Editar Cliente</title>
</head>
<body>
<button onclick="goBack()">Voltar</button>
<br><br>
<form action="editar.php?id=<?php echo $id; ?>" method="post">
    <input type="email" value="<?php echo $clientes['email'] ?? ''; ?>" name="email" placeholder="Email">
    <br><br>
    <input value="<?php echo $clientes['nome'] ?? ''; ?>" type="text" name="nome" placeholder="Nome Completo">
    <br><br>
    <input type="text" value="<?php echo $clientes['numero'] ?? ''; ?>" name="numero" placeholder="Número de Telefone">
    <br><br>
    <input type="text" value="<?php echo $clientes['dat'] ?? ''; ?>" name="data" placeholder="Data de Nascimento">
    <br><br>
    <input type="submit" value="Atualizar Dados">
</form>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
