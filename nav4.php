<?php 
$nome = $_SESSION['usuario'];
$img = isset($_GET['img']) ? $_GET['img'] : '';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
<style>

.ola{

padding-left: 34rem;
color:  #545F71 ;
font-size: 25px;
padding-top: 1rem;
}


 .openbtn{
padding-top: 0.5rem;
padding-right: 0.8rem;
padding-bottom: 0.5rem;
padding-left: 0.8rem;
border: none;
outline: none;

border-radius: 3rem;

}

.openbtn:hover{

    background-color: #545F71;
    transition: 1s;

}


.button1{
  background-color: #add8e6;
  border-radius: 1rem ;
  border: none;
  margin: 16px;
  padding: 0.5rem;

}

#voltar{

background-color: #add8e6;
border-radius: 3rem;
outline: none;
border: none;
padding: 1rem;
margin: 10px;
}

#voltar:hover{

    background-color: aqua;
    transition: 1s;
  


}

.opaa1 .suport{

align-items: right;

}


.pppa{

border-color : aqua ;
padding: 0.5rem;
border-radius: 1rem ;


}

img{
border-radius: 1rem ;

}

body.light-mode {
            background-color: #D9D9D9;
            color: #000;
transition: 2s;

        }

        /* Estilos para o tema noturno */
        body.dark-mode {
            background-color: #333;
      transition: 1.3s;
      color: white;
        }


        .container-fluid.dark-mode {
            background-color: #333;
            color: #fff;
            transition: 1.3s;
        }


#mudar{

border-radius: 1rem ;
border: none ;
background-color:  #add8e6;  
padding: 1rem ;
margin-left: 1rem ;
}



</style>
</head>
<body>
    


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

 
  <button class="ola" onclick="ola()" alt="voltar" id ="voltar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </button>

            

  <button class="openbtn" onclick="abrir()">&#9776;</button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <button id="mudar" onclick="toggleDarkMode()">Alternar Tema</button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

   

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <p class="ola" href="logout.php" > Bem vindo pet       <?php  if ( isset($_COOKIE['salvar']) ){  
                        echo $_COOKIE['salvar'];
                    
                    }
                         ?>  ao petgram
                </p>
        </li>

      
    
      </ul>

    

      <button type="button" class="button1" onclick="redirect()" > + </button>

   


            <form action="client.php" method="GET">
               
        <input type="hidden" name="nome" value="<?php echo urlencode($nome); ?>" >
        <button class="pppa" type="submit" > <img class="pppaa" src= "<?php  echo $_COOKIE['image'];
              ?>" alt="imagem da conta" width="40px" height = "40px"> 
            <?php   if (isset($_COOKIE['salvar'])) {
            echo $_COOKIE['salvar'];
        }
        ?>  </button> 
    </form>




          
    </div>
  </div>
</nav>

<script>


function redirect(){

window.location.href = 'post.php'

}


function toggleDarkMode() {
        const body = document.body;
        body.classList.toggle("dark-mode"); 
    }

function abrir() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }
</script>
</body>
</html>