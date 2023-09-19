<?php  
if (!isset($_SESSION)) {
session_start();


}
if ( session_destroy() === true){
header('location: index.php');
}

?>



