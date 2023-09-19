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

padding-left: 31rem;
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
  padding-top: 0.5rem;
padding-bottom: 0.5rem;
padding-left: 1rem;
padding-right: 1rem;

}


.button1:hover{
background-color: aqua;
transition: 1s;

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


.pppa:hover{

background-color: aqua;
transition: 3s;

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
        }


        .container-fluid.dark-mode {
            background-color: #333;
            color: #fff;
            transition: 1.3s;
        }

#mudar{
margin-left: 1rem;
border-radius: 1rem ;
border: none ;
background-color:  #add8e6;  
padding: 1rem ;
}


</style>
</head>
<body>
    



</body>
</html>