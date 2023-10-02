<?php
include('conexao.php');

$erro = '';

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['enviar'])) {
    $email = $_POST['usuario'];
    $senha = $_POST['senha'];
    $sql_code = "SELECT id, nome, img, senha FROM clientes WHERE email = ? OR nome = ? LIMIT 1";
    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param("ss", $email, $email); 
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
       
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['id'];
            
            header("Location: dashboard2.php?nome=" . urlencode($usuario['nome']) . "&img=" . urlencode($usuario['img'])  . "&id=" . urlencode($usuario['id']));
            exit;
     
          
         
        }
    } else {
        $error = 'Email/nome ou senha não encontrado';
        
    }
}






if (isset($_SESSION['usuario'])) {
    header("Location: dashboard2.php");
    exit; 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200&family=Open+Sans:wght@300&family=Playfair+Display:ital,wght@1,500&family=Roboto+Mono:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style> 


*{

    font-family: Arial, sans-serif;

}

h1{
color: rgb( 212, 122, 97);
text-transform: uppercase;
font-weight: bold;
text-shadow: 3px 3px black;


}
    body {
 background-image: url(dono-do-animal-de-estimacao-voltando-para-casa-abrindo-a-porta-o-cao-que-encontra-a-mulher-que-retorna-na-casa-entra-cachorrinho-cumprimentando-pessoa-sentado-no-tapete-de-entrada-estilo-de-vida-solo-ilustracao-veto.avif);
background-repeat: no-repeat;
background-size: 1080px;
        
    

}

.img2{
width: 700px;


}





.login{
border: solid;
background: rgb( 245, 223, 210);

box-shadow: 0 0 16px rgba(245, 0, 0, 5);
border: none;
padding-top: 10rem;
padding-bottom: 10rem;
padding-left: 7rem;
padding-right: 7rem;
border-radius: 2rem;
}

.login .logi2{
padding-bottom: 3rem;

}


  


.input-group-append .ola{

border-color : #aaf ;
border-radius: 0.7rem;



}
 .entrar1{
margin: 7px;
}

.entrar1 .ola{

    border-radius: 1rem;
    padding-top: 0.3rem;
padding-bottom: 0.3rem;
padding-left: 1rem;
padding-right: 1rem;
border-color: purple;

} 
.entrar1 .ola:hover{

background-color: rgb( 212, 122, 97);
transition: 1s;

}

a{
font-size: 20px;
color:   white;
outline: none;
text-decoration: none;

}


.afastar{

padding-left: 50rem;

}

.imagem2{

border-radius: 6rem;
width: 60px;

}
.esquerda{

z-index: 2;


}

.alinhar{

    padding-right: 10rem;
display: flex;
justify-content: right;
align-items: center;

}



.error{


color: red;

}

</style>

</head>
<body>











    <div class="alinhar " style="min-height: 100vh;">
        <div class="login">
            <div class="logi2">



                <h1> <img src="download.jpeg" class="imagem2"> Login </h1>
            </div>
            <form action="" method="post">
                <input type="text" class="email form-control mb-2" id="email" name="usuario" placeholder="Insira o email ou usuario"  required>
                <div class="input-group">
                    <input type="password" id="password" name="senha" placeholder="Digite sua senha" class="form-control" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-light" id="toggle">
                            <i id="toggleIcon" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>


<p class="error"> <?php  if(isset($erro)){

$erro;

}


  ?>   </p>

<p class="error"> <?php if(isset($error)){


echo $error;

}

?>
</p>

                <div class="entrar1">
<input type="checkbox" name="check" required> Aceita nossos termos? <br>caso não o conheça </input> <a href="termo.php">clique aqui </a>
<br> <br> 
                    <input type="submit" name="enviar" class="ola" value="Entrar" id="entrar">
                    <a href="criar.php">Criar conta</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script>



        const passwordInput = document.getElementById("password");
        const toggleButton = document.getElementById("toggle");
        const toggleIcon = document.getElementById("toggleIcon");

        toggleButton.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.className = "fas fa-eye";
            } else {
                passwordInput.type = "password";
                toggleIcon.className = "fas fa-eye-slash";
            }
        });
    </script>
</body>
</html>
