<?php
include('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
    die("Você não está logado");
}

$idUsuarioLogado = $_SESSION['usuario'];

if (isset($_GET['nome']) && is_numeric($_GET['nome'])) {
    $id = $_GET['nome'];

    if ($id != $idUsuarioLogado) {
        echo "Você não tem permissão para acessar e editar este perfil .    
  
        <p>Redirecionando em <span id='tempo-restante'>5 segundos </span></p>
        
        <script>
        var segundos = 5; // Defina o número de segundos para o cronômetro
        function iniciarCronometro() {
            var contador = setInterval(function() {
                document.getElementById('tempo-restante').innerHTML = segundos + ' segundos ';
                segundos--;
                if (segundos < 0) {
                    clearInterval(contador);
                    window.location.href = 'dashboard.php'; 
                }
            }, 1000); // Atualiza a cada 1 segundo
        }
        window.onload = iniciarCronometro;
    </script>

        ";
        die();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $numero = $_POST['numero'];
        $data = $_POST['data'];
        $descricao = $_POST['descricao'];

        if (isset($_FILES['file'])) {
            $arquivo = $_FILES['file'];

            if ($arquivo['error']) {
                $erro = 'Falha ao enviar o arquivo';
            }

            if ($arquivo['size'] > 2097152) {
                $erro = 'Tamanho de arquivo muito grande';
            }

            $pasta = "uploads/";

            $nomeA = $arquivo['name'];
            $novo = uniqid();
            $extensao = strtolower(pathinfo($nomeA, PATHINFO_EXTENSION));

            if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg") {
                $erro = 'Você está tentando enviar um arquivo que não é uma imagem';
            }

            $path = $pasta . $novo . "." . $extensao;
            $caminho_completo = $path;

            $enviado = move_uploaded_file($arquivo['tmp_name'], $caminho_completo);
        }

        if ($mysqli->connect_errno) {
            echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        } else {
            $checkEmailQuery = "SELECT COUNT(*) FROM clientes WHERE email = ?";
            $stmtCheckEmail = $mysqli->prepare($checkEmailQuery);
            $stmtCheckEmail->bind_param("s", $email);
            $stmtCheckEmail->execute();
            $stmtCheckEmail->bind_result($emailCount);
            $stmtCheckEmail->fetch();
            $stmtCheckEmail->close();

            if ($emailCount > 0) {
                echo '<br>', ' <div class="belau"> <div class="afastar"> <p>  O email já está em uso</p> </div></div> ';
            } else {
                $checkNomeQuery = "SELECT COUNT(*) FROM clientes WHERE nome = ?";
                $stmtCheckNome = $mysqli->prepare($checkNomeQuery);
                $stmtCheckNome->bind_param("s", $nome);
                $stmtCheckNome->execute();
                $stmtCheckNome->bind_result($nomeCount);
                $stmtCheckNome->fetch();
                $stmtCheckNome->close();

                if ($nomeCount > 0) {
                    echo '<br>', ' <div class="belau"> <div class="afastar"> <p >  O nome já está sendo usado por outro usuário </p> </div></div> ';
                }

                $stmt = $mysqli->prepare("UPDATE clientes SET img = ?, nome = ?, email = ?, numero = ?, dat = ?, descricao = ? WHERE id = ?");
                $stmt->bind_param("ssssssi", $path, $nome, $email, $numero, $data, $descricao, $id);




                if ($stmt->execute()) {
                    echo "Dados atualizados com sucesso!";
                    // Redirecione para a página de perfil ou outra página apropriada
                    header("location: dashboard.php?nome=$nome");
                    exit();
                } else {
                    echo "Erro ao atualizar dados: " . $stmt->error;
                }
            }
        }
    }

    $sql = "SELECT img, email, nome, numero, dat, descricao FROM clientes WHERE id = $id";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $clientes = $result->fetch_assoc();

        $image = $clientes['img'];
        $email = $clientes['email'];
        $nome = $clientes['nome'];
        $numero = $clientes['numero'];
        $data = $clientes['dat'];
        $descricao = $clientes['descricao'];
    } else {
        echo "Cliente não encontrado.";
        die();
    }
} else {
    echo "<button onclick=\"window.location.href='dashboard.php'\"><img src='64431.png' id='img' width='30px'></button>";
    echo "ID de cliente inválido ou você não está logado. Pressione o botão e tente novamente mais tarde.";
    die();
}
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="client.css" media="screen" />
    <title>Editar Cliente</title>
<style>

.center{
padding-left: 50rem;
padding-top: 6rem;
    
    }
    
    #config{
    margin: 5px;
   border: none;
    border-radius: 1rem ;
    padding-left: 1rem ;
    padding-top: 1rem ;
    padding-bottom: 1rem ;
    padding-right: 5rem ;
    background-color: #e7dfdf;
    }

    #config:focus{
      
        transition: 0.7s;
outline-color: aqua ;


    }

    .opa{
        margin: 5px;
       border: none;
        border-radius: 1rem ;
        padding-left: 1rem ;
        padding-top: 1rem ;
        padding-bottom: 1rem ;
        padding-right: 5rem ;
        background-color: #e7dfdf;
        }
    
        .opa:focus{
          
            transition: 0.7s;
    outline-color: aqua ;
    
    
        }
    


    
    .senha{
        margin: 5px;
       border: none;
        border-radius: 1rem ;
        padding-left: 1rem ;
        padding-top: 1rem ;
        padding-bottom: 1rem ;
        padding-right: 5rem ;
       
        }


        .senha:focus{
      
            transition: 1s;
    outline-color: aqua ;
    
    
        }

    #img2{
border: 1px solid;
border-color: aqua;
border-radius: 3rem ;
padding: 1rem;

    }

    .radius{

border-radius: 1rem;
border-color: aqua;

    }


    .radius2{

        border-radius: 1rem;
        border-color: aqua;
        padding-left: 5rem;
        padding-right: 6rem;
        padding-top: 1rem;
        padding-bottom: 1rem;
            }

            .radius2:hover{
background-color: cadetblue;
transition: 1s;


            }

            .center2{
margin-bottom: 2rem;
                padding-left: 6rem;
            }
            
            
            .center2  img{

border-radius: 3rem;

            }
            .img {
                width: 50px;
            }
    
            #passoword {
    
    
                margin: 5px;
                border: none;
                border-radius: 1rem;
                padding-left: 1rem;
                padding-top: 1rem;
                padding-bottom: 1rem;
                padding-right: 5rem;
            }
    
    
            .passoword:focus {
    
                transition: 1s;
                outline-color: aqua;
    
    
            }
    
            .radius {
    
                padding-top: 1rem;
                border: none;
    
    
            }
    
    
            .radius:hover {
    
                background-color: #add8e6;
                transition: 2s;
            }
    
            .retorna {
    
                padding-left: 3rem;
    
            }

</style>
   
</head>

<body>


    <div class="retorna">

        <button class="radius" onclick="goBack()"> <img id="radius" src="64431.png" id="img" width="30px">
            <br><br>
            <p>
                <?php echo "ola $nome clique aqui caso deseje voltar ao dashboard"; ?>
            </p>
        </button>
    </div>

    <div class="center">
        <div class="center2">
            <form action="" method="post" enctype="multipart/form-data">
                <img src="<?php echo $image; ?>" alt="" value="<?php echo $image; ?>"  srcset="" width="70px" height="70px">
                <input type="file" name="file" value="enviar aqui">
        </div>


        <h4><strong> fazer uma pagina no qual você acessa sua propia conta Editar Informações do perfil </strong></h4>
        <br>

        <input id="config" type="email" value="<?php echo $email; ?>" name="email" placeholder="Email">
        <br><br>
        <input id="config" value="<?php echo $nome; ?>" type="text" name="nome" placeholder="Nome Completo">
        <br><br>

        <input id="config" type="text" value="<?php echo $descricao; ?>" name="descricao" placeholder="DESCRIÇÃO DA CONTA">
        <br><br>
        <input type="tel" id="config" value="<?php echo $numero; ?>" name="numero" placeholder="Número de Telefone">
        <br><br>
        <input type="date" id="config" value="<?php echo $data; ?>" name="data" placeholder="Data de Nascimento">
        <br><br>

        <br><br>
        <input class="radius2" type="submit" value="Atualizar Dados">

        </form>
    </div>
    <script>
        function goBack() {
            window.location.href = 'dashboard.php';
        }


        const passwordInput = document.getElementById("passoword");
        const toggleButton = document.getElementById("toggle");
        const toggleIcon = document.getElementById("toggleIcon");

        toggleButton.addEventListener("click", function () {
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