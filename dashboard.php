<?php
session_start();

include('conexao.php');
include('nav.php');

if (isset($_POST['enviar'])) {
    $email = $_POST['usuario'];
    $senha = $_POST['senha'];


    $sql_code = "SELECT id, nome, img, senha FROM clientes WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['id'];
            header("Location: dashboard.php?nome=" . urlencode($usuario['nome']) . "&img=" . urlencode($usuario['img']));
            exit;
        } else {
            echo 'Email ou senha incorretos';
        }
    } else {
        echo 'Email não encontrado';
    }
}


$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$img = isset($_GET['img']) ? $_GET['img'] : '';

$duracao = time() + (30 * 24 * 60 * 60);

if (isset($_GET['img'])) {

    $image = $_GET['img'];
    if (setcookie("image", $_GET['img'], $duracao))
        ;




}



if (isset($_GET['id'])) {

    $id = $_GET['id'];
    if (setcookie("id", $_GET['id'], $duracao))
        ;}

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];

    if (setcookie("salvar", $_GET['nome'], $duracao))
        ;



}






if (isset($_POST['ola'])) {
    $nome = $_POST['ola'];

    $pesquisar = "SELECT id, img, nome FROM clientes WHERE nome LIKE ?";

    $stmt = $mysqli->prepare($pesquisar);

    $param = "%$nome%";

    $stmt->bind_param("s", $param);

    $stmt->execute();

    $result = $stmt->get_result();
}

$sql_busca = "SELECT nome, email FROM clientes";
$sql_query = $mysqli->query($sql_busca);

$sql_clientes = "SELECT nome, numero, dat, email, id FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die;

$sql_id = "SELECT id, nome FROM clientes";
$query_nome = $mysqli->query($sql_id) or die;



if (isset($_POST['pe'])) {
    $nome = $_POST['pe'];

    $pesquisar = "SELECT img, nome FROM clientes WHERE nome LIKE ?";

    $stmt = $mysqli->prepare($pesquisar);

    $param = "%$nome%";

    $stmt->bind_param("s", $param);

    $stmt->execute();

    $resultado = $stmt->get_result();
}





?>



<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            background-color: #D9D9D9;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            width: 100vw;
            
        }


        .perfil {
            background-color: #fff;
            margin: 17px;

            border-radius: 5px;
            box-shadow: 5px 5px 10px #818181;
            max-width: 300px;


        }

        .perfil .mudar {
            margin: 1rem;
            margin-right: 10px;
            border-radius: 5px;
            border: none;


        }

        .ola {

            text-align: center;
        }

        .perfil p {
            margin: 0;
        }

        .right {
            display: flex;
            justify-content: center;
        }



        .sidebar {

            border: none;
            padding-left: 1rem;
            padding-right: 1rem;
            ;
            padding-top: 04rem;
            height: 100%;
            width: 400px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: whitE;
            overflow-x: hidden;
            transition: 0.5s;

        }

        .sidebar a {
            padding: 15px 10px;
            text-decoration: none;
            font-size: 20px;
            color: #545F71;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: black;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left 0.5s;
            padding: 16px;
        }


        .sidebar::after {

            z-index: 0;

        }

        .account .pa {
            font-size: 25px;
            color: #818181;
            font-family: Arial, sans-serif;
        }

        .account .pa:hover {

            color: #f1f1f1;
        }

        .account {
            border: none;
            padding-top: 28rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .pppa {

            border: 1px dotted;
            border-radius: 2rem;
            border-color: aqua;
            color: #545F71;
            font-size: 18px;

        }

        .pppa .pppaa {

            border-radius: 1rem;
            padding: 0.3rem;

        }

        .account img {

            border-radius: 3rem;


        }

        .arrow {
            background-color: #545F71;
            border-radius: 3rem;
            border: none;
            outline: none;
        }

        .account::after {
            border: none;



        }


        .right {

            padding-left: 64rem;
            text-align: center;

        }

        .pirulito {

            border: none;
            border-radius: 1rem;
            outline-color: #545F71;
        }


        .moldura {

            display: fixed;
            margin-right: 46rem;
            margin-left: 46rem;
            box-shadow: 5px 5px 10px #818181;
            position: relative;
            top: 50px;
        }

        .espaco {

            padding: 1rem
        }

        .uno {
            border-radius: 1rem;
            margin: 0.3rem;
        }

        .perfil .afa {
            margin: 3rem;

        }

        .container {
            height: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border: 1px solid #e6e6e6;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);

        }

        .post-header {
            height: 100%;
            padding: 16px;
            display: flex;
            align-items: center;
        }

        .post-header img {

            height: 100%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .post-image {
            padding-left: 1rem;
            height: 100px;

            width: 200px;
        }

        .post-actions {
            height: 100%;
            padding: 16px;
            border-top: 1px solid #efefef;
            display: flex;
            justify-content: space-between;
        }

        .post-actions button {
            height: 100%;
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .post-actions .left-actions {
            height: 100%;
            display: flex;
            gap: 10px;
        }

        .post-content {
            padding: 0 16px 16px;
        }

        .post-comments {
            padding: 0 16px 16px;
            font-size: 14px;
            color: #888;
        }


        .sidebar #pirulitin {
            padding: 0.4rem;

        }

        .post_image {
border-radius: 0rem;
            padding-left: 4rem;

        }

        .button23 {
            border: dashed;
            border-radius: 1rem;
            border-color: aqua;
            background-color: aqua;


        }


        #black {

            background-color: black;
            color: white;

        }
        .dark-mode .navbar {
    background-color: #111; /* Cor de fundo da barra de navegação no modo escuro */
    color: #fff; /* Cor do texto da barra de navegação no modo escuro */
}

#opa233{

border: none;


}






@media screen and (min-width: 380px) {
    .post_image {
        padding-left: 1rem;
        padding-right: 1rem;
        width: 100%;
    }
}

*{

align-items: center;

}

@media screen and (max-width: 480px) {
    .perfil {
        margin: 10px; /* Reduza a margem para telas menores */
    }
    
    .sidebar {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
    
    .post_image {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
}


    </style>
</head>

<body>



    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" id="nav" >


            <button class="ola" onclick="ola()" alt="voltar" id="voltar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </button>



            <button class="openbtn" onclick="abrir()">&#9776;</button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <button id="mudar" onclick="toggleDarkMode()">Alternar Tema</button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">



                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <p class="ola" href="logout.php"> Bem vindo pet
                            <?php if (isset($_COOKIE['salvar'])) {
                                echo $_COOKIE['salvar'];

                            }
                        

                            ?> ao petgram 
                            <?php if (isset($_COOKIE['id'])) {
                        
$id = $_COOKIE['id'];

                            }  ?> 
                        </p>
                    </li>



                </ul>



                <button type="button" class="button1" onclick="redirect()"> + </button>




                <form action="client.php?nome=$id" method="GET">

                    <input type="hidden" name="nome" value="<?php echo urlencode($id); ?>">
                    <button class="pppa" type="submit"> <img class="pppaa" src="<?php echo $_COOKIE['image'];
                    ?>" alt="imagem da conta" width="40px" height="40px">
                        <?php if (isset($_COOKIE['salvar'])) {
                            echo $_COOKIE['salvar'];
                        }
                        ?> </button>
                </form>





            </div>
        </div>
    </nav>


    <div id="mySidebar" class="sidebar">
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="0" height="60" fill="currentColor"
            class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
        </svg>
        <a href="#home"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="39" fill="currentColor"
                class="bi bi-house" viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
            </svg> Home </a>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="criar.php"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="39" fill="currentColor"
                class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg> criar outra conta</a>
        <a href="logout.php"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="39" fill="currentColor"
                class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                <path fill-rule="evenodd"
                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
            </svg> Sair  </a>





        <a href="post.php"> <button class="pirulito"> + </button> criar um novo post </a>




        <a href="adote.php"> <img src="dog-in-front-of-a-man.png" width="30px"> Adote um Pet </a>
        <br>
        <form class="d-flex" role="search" method="post">
            <input name="ola" id="pirulitin" class="form-control me-2" type="search" placeholder="Search"
                aria-label="Search" required>
            <button class="btn btn-outline-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg> </button>
        </form>
        <?php
        if (isset($result)) {
            while ($row = $result->fetch_assoc()) {




                echo '<div class="perfil">';
                echo '<form action="perfil.php" method="GET">';
                echo '<input type="hidden" name="id" value="' . urlencode($row['id']) . '">';
                echo '<br>';
                echo '<button class="mudar" type="submit"><img class="uno" src="' . $row['img'] . '" width="40px">' . $row['nome'] . '</button>';
                echo '</form> </div>';

            }
        }
        ?>










    </div>
    </div>
    </div>


    <div class="right">
        <div class="ola">







        </div>
    </div>



    <?php
    include('conexao.php');

    $sql = "SELECT id id_usuario, path, descricao, nome_usuario, image_usuario FROM post ORDER BY RAND()";
    $result = $mysqli->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row; // Adiciona cada post ao array de posts
    

        }
        $result->close();
    }

    foreach ($posts as $post) {
        echo renderPost($post);
    }

    $mysqli->close();

    function renderPost($post)
    {
$id = $post['id'];
        $nome = $post['nome_usuario'];
        $image = $post['image_usuario'];
        $pathAleatorio = $post['path'];
        $nomeAleatorio = $post['descricao'];
$idd = $post['id_usuario'];

        return "
    <div class='container' id='home'>
    <div class='post-header'>
    <form action='perfil.php' method='GET'>

<button id ='opa233'> 
        <img id='myImage'  ondblclick='like()' src='$image'>
        <strong> $nome  </strong>
</button>
<input type='hidden' name='id' value='$idd'>
</form>
    </div>
    <img class='post_image'  src='$pathAleatorio' width='500px'>
    <div class='post-actions'>
        <div class='left-actions'>
            <button class='like-button' onclick='likePost(this)'>❤️   <span class='like-number'>0</span></button>
            

            <button type='button' class='button23' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@mdo'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat-fill' viewBox='0 0 16 16'>
                    <path d='M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.180-1.234A9.06 9.06 0 0 0 8 15z'/>
                </svg>
            </button>

            <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>New message</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form method='POST'>
                                <div class='mb-3'>
                                    <label for='message-text' class='col-form-label'>Message:</label>
                                    <input name='comente' class='form-control' id='message-text'></textarea>
                                
                          
                        </div>
                        </div>
                         
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' id='black' data-bs-dismiss='modal'>Close</button>
                            <input type='submit'  id='black' class='btn btn-primary' value='Send message'></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button onclick='savePost()'>🔖</button>
    </div>
    <div class='post-content'>
        <p>$nomeAleatorio</p>
    
    </div>
    <div class='post-comments'>
        <p>View all 15 comments</p>
    </div>
</div>";
    }

    $mysqli = new mysqli('localhost', 'root', '', 'loja');
    if ($mysqli->connect_error) {
        die('Erro de conexão: ' . $mysqli->connect_error);
    }

   
$like3 = "SELECT COUNT (*) FROM like_count WHERE id = $id  "
        

    ?>


    <script>



function toggleDarkMode() {
    const body = document.body;

    
    if (body.classList.contains("dark-mode")) {
        body.classList.remove("dark-mode");
    } else {
   
        body.classList.add("dark-mode");
    }
}

const toggleButton = document.getElementById("toggleDarkMode");
toggleButton.addEventListener("click", toggleDarkMode);


        function likePost(button) {
            var likeCountElement = button.querySelector('.like-number');
            var currentLikeCount = parseInt(likeCountElement.textContent) || 0;
            currentLikeCount++;
            likeCountElement.textContent = currentLikeCount;
         
    }

        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle("dark-mode");
        }


        function abrir() {
            document.getElementById("mySidebar").style.height = "1000px";
            document.getElementById("mySidebar").style.width = "400px";
            document.getElementById("main").style.marginLeft = "300px";
        }

        function closeNav() {

            document.getElementById("mySidebar").style.height = "0";
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }






        function commentPost() {

            alert('Comment added!');
        }

        function savePost() {

            alert('Post saved!');
        }


        function redirect() {

            window.location.href = 'post.php'


        }

    </script>
</body>
