<?php
session_start();
include "header.php";
include "connect.php";


?>
<div style="height: 100vh;" class="container d-flex flex-column align-items-center justify-content-center">
    <div class="container  d-flex align-items-center ">

        <h1>Entrez vos identifiants s'il vous plait</h1>
    </div>
    <div class="container  d-flex align-items-center ">

        <form method="POST">
            <input type="text" name="login" placeholder="Login" value="">
            <input type="password" name="password" placeholder="Mot de passe" value="">
            <input class="btn btn-primary" type="submit" value="Connexion">
        </form>
        <a class="btn btn-secondary" href="./signin.php">Créer un compte</a>


        </div>

<?php
if (isset($_POST['login']) && isset($_POST['password']) && (!empty($_POST['login'])) && (!empty($_POST['password']))) {

    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);


    $sql = 'SELECT * FROM login WHERE login = :login';
    $query = $db->prepare($sql);
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $user = $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo '<h4> Désolé cet utilisateur n\'existe pas!</h4>';
    } else {
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $login;
            header('location: ./index.php');
        } else {
            echo '<h4> Mauvais mot de passe.</h4>';
        }
    }
}




?>    


</div>
