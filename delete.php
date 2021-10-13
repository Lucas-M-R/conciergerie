<?php
include 'connect.php';
$intervention = connect()->query("SELECT * FROM `intervention`");
if (isset($_GET['id'])) {
    $suppression = connect()->prepare('DELETE FROM intervention WHERE id_intervention = ?');
    $suppression->execute([$_GET['id']]);
    echo "Intervention supprimée!";
    if (!$intervention) {
        exit('Cette intervention n\'existe pas!');
    }
} else {
    exit('');
} 
header('location: ./conciergerie.php');