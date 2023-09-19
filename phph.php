<?php

session_start();

include('conexao.php');
include('nav.php');
include('buscar.php');

if (!isset($_SESSION['usuario'])) {
    echo "Você não está logado";
    header("Location: index.php");
    die("Você não está logado");
}

$nome = $_SESSION['usuario'];

$duracao = time() + (30 * 24 * 60 * 60);

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];
    setcookie("salvar", $_GET['nome'], $duracao);
}

$sql_clientes = "SELECT nome, numero, dat, email, id FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die;

$sql_id = "SELECT id, nome FROM clientes";
$query_nome = $mysqli->query($sql_id) or die;
?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            border: solid 1px #545F71;
            padding-top: 10rem;
            min-height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.5s;
        }

        .sidebar a {
            padding: 15px 10px;
            text-decoration: none;
            font-size: 18px;
            /* Tamanho de fonte menor para telas menores */
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
            font-size: 24px;
            /* Tamanho de fonte menor para telas menores */
            margin-left: 50px;
        }

        #main {
            transition: margin-left 0.5s;
            padding: 16px;
        }

        .account .pa {
            font-size: 18px;
            /* Tamanho de fonte menor para telas menores */
            color: #818181;
            font-family: Arial, sans-serif;
        }

        .account .pa:hover {
            color: #f1f1f1;
        }

        .account {
            padding-top: 20rem;
            /* Ajuste o espaço superior conforme necessário */
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .account .pppa {
            border: solid;
            border-radius: 1rem;
            border-color: aquamarine;
            color: #545F71;
            font-size: 16px;
            /* Tamanho de fonte menor para telas menores */
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

        .ola {
            text-align: right;
            padding-right: 1rem;
        }

        .ola .perfil {
            font-size: 18px;
            /* Tamanho de fonte menor para telas menores */
            color: #818181;
            border: solid 1px #818181;
            width: 150px;
            /* Reduza a largura conforme necessário */
            padding-right: 0.5rem;
            /* Ajuste o espaço direito conforme necessário */
        }

        .right {
            padding-left: 6rem;
            /* Ajuste o espaço esquerdo conforme necessário */
            text-align: center;
        }

        .pirulito {
            border-color: #545F71 1px;
            border-radius: 1rem;
            outline-color: #545F71;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                /* Barra lateral ocupa toda a largura da tela */
                padding-top: 2rem;
                /* Espaçamento superior menor */
                text-align: center;
            }

            .sidebar a {
                font-size: 16px;
                /* Texto menor na barra lateral para telas menores */
            }

            .sidebar .closebtn {
                right: 10px;
                /* Posição do botão de fechar ajustada */
            }

            .account {
                padding-top: 12rem;
                /* Espaçamento superior menor */
            }

            .account .pppa {
                font-size: 14px;
                /* Tamanho de fonte menor para telas menores */
            }

            .ola {
                text-align: center;
                /* Texto de cumprimento centralizado */
            }

            .ola .perfil {
                width: auto;
                /* Largura do perfil automática */
                padding-right: 0;
                /* Espaçamento direito removido */
            }

            .right {
                padding-left: 0;
                /* Espaçamento esquerdo removido */
            }
        }
    </style>

</head>

<body>


    <div id="mySidebar" class="sidebar">
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="0" height="60" fill="currentColor"
            class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
        </svg>
        <a href="dashboard.php"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="39" fill="currentColor"
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
            </svg> Sair</a>

        <a href="post.php"> <button class="pirulito"> + </button> criar um novo post </a>


        <div class="account">


            <form action="client.php" method="GET">
                <input type="hidden" name="nome" value="<?php echo urlencode($nome); ?>">
                <button class="pppa" type="submit"> <img src="download.jpeg" alt="imagem da conta" width="40px">
                    <?php if (isset($_COOKIE['salvar'])) {
                        echo $_COOKIE['salvar'];
                    }
                    ?>
                </button>
            </form>







        </div>
    </div>
    </div>

    <script>
        function abrir() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>