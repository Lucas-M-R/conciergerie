<?php    
     
function connect()
        {
            $user = 'root';
            $pass = '';
            // $user = 'lucasm';
            // $pass = 'vFOn/JNjoSjNuw==';
            try {
                return new PDO('mysql:host=localhost; dbname=conciergerie', $user, $pass);
                // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "erreur : " . $e->getMessage() . "<br>";
            }
        }
    
        


    


    
    define('HOST', 'localhost');
    // Nom d'utilisateur
    define('USER', 'root');
    // Mot de passe
    define('PASSWD', '');
    // Nom de la base de donnée
    define('DBNAME', 'conciergerie');
    
    try {
        $db = new PDO("mysql:host=". HOST .";dbname=". DBNAME, USER, PASSWD, [
            // Gestion des erreurs PHP/SQL
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            // Gestion du jeu de caractères
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            // Choix du retours des résultats
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    catch (Exception $error) {
        // Attrape une exception
        echo 'Erreur lors de la connexion à la base de données : '. $error->getMessage();
    }
    