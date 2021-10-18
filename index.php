<?php session_start();

include "header.php";
// var_dump($_SESSION['logged']);

// die;




if(isset($_SESSION['logged'])){
    header("Location: ./conciergerie.php");
}
else{
    header("Location: ./login.php");
}
?>
