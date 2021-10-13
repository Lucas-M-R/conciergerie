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
        
