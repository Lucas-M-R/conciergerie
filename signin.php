<?php session_start(); 
include "header.php";
include "connect.php";








?>
<div style="height: 100vh;" class="container  d-flex align-items-center ">

<h1>Nouvel utilisateur :</h1>

<form method="POST">
    <input type="text" name="login" placeholder="Login" value="">
    <input type="password" name="password" placeholder="Mot de passe" value="">
    <input class="btn btn-success" type="submit" value="Creer nouveau compte">
</form>

</div>




<?php
if(isset($_POST['login']) && isset($_POST['password']) && (!empty($_POST['login'])) && (!empty($_POST['password']))){
   $login = strip_tags($_POST['login']);
   $password = strip_tags($_POST['password']);

   $password = password_hash($password, PASSWORD_DEFAULT);

   $sql = 'INSERT INTO login (login, password) VALUES (:login, :password)';

   $query = $db->prepare($sql);
   $query->bindvalue(':login', $login, PDO::PARAM_STR);
   $query->bindvalue(':password', $password, PDO::PARAM_STR);
   $query->execute();
   header('Location: ./index.php');
}
?>





    $_SESSION['logged']=true;
    header("location: ./conciergerie.php");
}
?>