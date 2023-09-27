<?php  
include('conexao.php');

if (isset($_POST['pe'])) {
    $nome = $_POST['pe'];

    $pesquisar = "SELECT id, img, nome FROM clientes WHERE nome LIKE ?";

    $stmt = $mysqli->prepare($pesquisar);

    $param = "%$nome%";

    $stmt->bind_param("s", $param);

    $stmt->execute();

    $result = $stmt->get_result();
}


?>

<!DOCTYPE html>
<html>
<head>
    <style>
         body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            border: solid 1px #545F71;
            padding-top: 10rem;
            height: 100%;
            width: 0px;
            position: fixed;
            top: 0;
            left: 0;
            background-color:whitE;
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



.account .pa{
    font-size: 25px;
    color: #818181;
    font-family: Arial, sans-serif;
}
 .account .pa:hover{

    color: #f1f1f1;
}

.account{
padding-top: 28rem;
padding-left: 1rem;
padding-right: 1rem;
}

.account .pppa{
border:solid ;
border-radius: 1rem;
border-color: aquamarine;
color:#545F71;
font-size: 18px;

}


.account img{

border-radius: 3rem;


}
.arrow{ 
background-color: #545F71;
border-radius: 3rem;
border: none;
outline: none;
 }


 .ola{
text-align: right;
padding-right: 1rem;


}


  .ola .perfil{

    font-size: 25px;
    color: #818181;
    border: solid 1px #818181 ;
    width: 200px;
    padding-right: 1rem ;
}

.right{

padding-left: 64rem;
text-align: center;

}


.perfil {
            background-color: #fff;
            margin: 17px;
           
            border-radius: 5px;
            box-shadow: 5px 5px 10px #818181;
            max-width: 300px;
        
         
        }
        .perfil .mudar{
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

    </style>
</head>
<body>
 

<div id="mySidebar" class="sidebar">



  <a href="dashboard.php">  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="39" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
</svg>  Home </a>
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="criar.php"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="39" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>  criar outra conta</a>
  <a href="logout.php"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="39" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
</svg> Sair</a>

<form class="d-flex" role="search"  method="post">
        <input name="pe" id="pirulitin" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" required>
        <button class="btn btn-outline-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg> </button>
      </form>
      <?php
    if (isset($result)) {
        while ($row = $result->fetch_assoc()) {
    
          
    
    
            echo '<div class="perfil">';
    echo '<form action="pesquisa.php" method="GET">';
    echo '<input type="hidden" name="id" value="' . urlencode($row ['id']) . '">';
    echo '<br>';
    echo '<button class="mudar" type="submit"><img class="uno" src="' . $row['img'] . '" width="40px">' . $row['nome'] . '</button>';
    echo '</form> </div>';
    
        }
    }
?>

    </div>
    </div>
    <script>


        function ola() {
            window.history.back()
        }

        function abrir() {
            document.getElementById("mySidebar").style.width = "400px";
            document.getElementById("main").style.marginLeft = "400px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>
</html>