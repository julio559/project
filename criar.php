<?php
include ('conexao.php');
include ('insertc_client.php');

$senha = isset(  $_POST['senha']);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        
        // Perform a SELECT query to retrieve data based on email
        $sql_code = "SELECT * FROM clientes WHERE email = '$email'";
        $result = $mysqli->query($sql_code);

        if ($result) {
            $row = $result->fetch_assoc();


            if ($row) {
                // Fetch other data from the row if needed
                $nome = $row['nome'];
                $numero = $row['numero'];
                $data = $row['data'];
            } else {
                echo "Nenhum registro encontrado para o email informado.";
            }
        } else {
            echo "Erro ao buscar dados: " . $mysqli->error;
        }
    }
}


?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&family=Open+Sans:wght@300&family=Playfair+Display:ital,wght@1,500&family=Roboto+Mono:ital,wght@1,500&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <style>
        /* Adicione estas regras CSS para alinhar a imagem à esquerda e os inputs à direita */
        .ola {
            display: flex;
            align-items: center;
        }

        .image-left img {
            float: left; /* Alinhe a imagem à esquerda */
            margin-right: 20px; /* Adicione margem à direita da imagem */
        }

        .direita {
            
            padding-left: 21rem;
            padding-top: 3rem;

            
        }

        .direita input {
            width: 100%; 
        margin-left: auto; 
        }

        .direita #opa{
    font-family: 'Inter', sans-serif;
font-family: 'Open Sans', sans-serif;
font-family: 'Playfair Display', serif;
font-family: 'Roboto', sans-serif;
font-family: 'Roboto Mono', monospace;
    background-color: rgba(173, 216, 230, 0.3);
padding-top: 0.6rem;
padding-bottom: 0.6rem;
padding-right: 12rem;
border: none;
outline: none;
padding-left: 1rem;
}

.direita #opa:focus{

outline-color: purple;

}

.direita #ola{

padding-left: 9rem;
padding-right: 9rem;
padding-top: 1rem;
padding-bottom: 1rem;
border-radius: 0.5rem;
border: none;
background: linear-gradient(to bottom,  #add8e6, #b7d5e5);
}

.direita #ola:hover{

background-color: aqua;
transition: 1s;

}

.direita .ola{

    font-family: 'Inter', sans-serif;
font-family: 'Open Sans', sans-serif;
font-family: 'Playfair Display', serif;
font-family: 'Roboto', sans-serif;
font-family: 'Roboto Mono', monospace;
    background-color: rgba(173, 216, 230, 0.3);
padding-top: 0.6rem;
padding-bottom: 0.6rem;
padding-right: 12rem;
border: none;
outline: none;
padding-left: 0.3rem;


}

.lembrar{
display: block;



}

#voltar{

background-color: #add8e6;
border-radius: 3rem;
outline: none;
border: none;
padding: 1rem;

}

#voltar:hover{

    background-color: aqua;
    transition: 1s;
  


}


.custom-file-input {
            display: none;
        }

        .custom-file-label {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-file-label:hover {
            background-color: #2980b9;
        }

        .selectedImage{

border-radius: 3rem;

        }

    </style>
</head>
<body>
    <div class="ola image-left"> <!-- Adicione a classe 'image-left' aqui -->
        <img src="pessoa-e-animal-de-estimacao-personagem-de-dono-de-animal-de-estimacao-homem-segurando-nas-maos-de-seu-cachorro-o-homem-ama-seu-animal-animal-domestico-fofo-e-adoravel_93083-590.avif" alt="" width="800px" height="1000">
        <button onclick="ola()" alt="voltar" id ="voltar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </button> 
        <div class="direita">
       

            <h1> Criar conta </h1>
            <form action="insertc_client.php" method="post" enctype="multipart/form-data" >
<br>

            <div class="col-auto">
            
    <input type="file" name="file" id="selectedImage" class="btn btn-primary mb-3" placeholder = "escolha sua foto de perfil" required  >
  </div>
<br>

                <input type="email" value="<?php echo $email ?? ''; ?>" name="email" id="opa" placeholder="email" required >
                <br><br><br>
                <input value="" type="text" name="nome" id="opa" placeholder="nome de usuario" required >
                <br><br><br>
                <input type="number" value="<?php echo $numero ?? ''; ?>" name="numero" id="opa" placeholder="numero de telefone" required>
                <br><br><br>
                <input type="date" value="<?php echo $dat ?? ''; ?>" name="data" id="opa" placeholder="data" required>
                <br><br><br>
                <input type="password" name="senha" class="ola" id="senha" placeholder="senha" required>
           


<button type="button" class="btn btn-light" id="toggle">
    <i id="toggleIcon" class="fas fa-eye-slash"></i>
</button>


                
                <br><br>
                <div class="lembrar">
                
                <br><br>
                </div>
                <input type="submit" id="ola" onclick="" value="enviar dados">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script>
        function ola() {
            window.history.back()
        }

        const passwordInput = document.getElementById("senha");
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


 

        const fileInput = document.getElementById('fileInput');
        const selectedImage = document.getElementById('selectedImage');

       
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0]; 

            if (file) {
               
                const imageUrl = URL.createObjectURL(file);

              
                selectedImage.src = imageUrl;
            } else {
             
                selectedImage.src = '';
            }
        });
   

    </script>
</body>
</html>