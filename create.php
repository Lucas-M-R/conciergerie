<?php
include 'connect.php';

if (!empty($_POST['dateIntervention']) && !empty($_POST['typeIntervention']) && !empty($_POST['etageIntervention'])) {
            $sth = connect()->prepare('INSERT INTO intervention(date_intervention,type_intervention,etage_intervention)
VALUES (:date_intervention,:type_intervention,:etage_intervention)');
            $sth->execute(array(
                ':date_intervention' => $_POST['dateIntervention'],
                ':type_intervention' => $_POST['typeIntervention'],
                ':etage_intervention' => $_POST['etageIntervention']
            ));
            // echo "Entrée ajoutée dans la table";
            
        }
        header('location: ./conciergerie.php');

        