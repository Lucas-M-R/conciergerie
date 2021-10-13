<?php include "header.php";
include_once "connect.php";

$rechercheDate = isset($_GET['dateIntervention']) ? $_GET['dateIntervention'] : '';
$rechercheType = isset($_GET['typeIntervention']) ? $_GET['typeIntervention'] : '';
$rechercheEtage = isset($_GET['etageIntervention']) ? $_GET['etageIntervention'] : '';

$searchrequestEtage = connect()->query(" SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE etage_intervention = '$rechercheEtage'");

$searchrequestType = connect()->query(" SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE type_intervention LIKE '$rechercheType'");

$searchrequestDate = connect()->query(" SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE date_intervention = '$rechercheDate'");

// var_dump($rechercheDate);
// var_dump($searchrequestDate);


?>
<table class="table table-striped">
    <thead class="table-dark">
        
            <h4 class="d-flex justify-content-center"><?= 'Résultat de la recherche' ?></h4>
        
        <tr>
                    <th colspan="1" >Date</th>
                    <th colspan="1">Interventions</th>
                    <th colspan="1">Etages</th>
                    <th colspan="1"></th>
                 
                </tr>
    </thead>
    <tbody>
        <?php

if (isset($_GET['etageIntervention'])) {
    $searchrequestetage2 = connect()->prepare("SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE etage_intervention = :rechetage");
    $searchrequestetage2->bindParam(":rechetage", $_GET['etageIntervention'], PDO::PARAM_STR);
    $resultetage = $searchrequestetage2->execute();

    while ($tableauRecherche = $searchrequestetage2->fetch(PDO::FETCH_ASSOC)) {
        $idsearch = $tableauRecherche['id_intervention'];
?>
        <tr>
            <td> <?= $tableauRecherche['date_intervention']; ?></td>
            <td> <?= $tableauRecherche['type_intervention']; ?></td>
            <td> <?= $tableauRecherche['etage_intervention']; ?></td>
            <td><a class="btn btn-danger" href="./delete.php?id=<?= $idsearch ?>">Supprimer l'entrée et revenir à l'accueil</a></td>
        </tr>
    <?php
    }
}


      else  if (isset($_GET['dateIntervention'])) {
            $searchrequestDate2 = connect()->prepare("SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE date_intervention = :rechdate");
            $searchrequestDate2->bindParam(":rechdate", $_GET['dateIntervention'], PDO::PARAM_STR);
            $resultdate = $searchrequestDate2->execute();

            while ($tableauRecherche = $searchrequestDate2->fetch(PDO::FETCH_ASSOC)) {
                $idsearch = $tableauRecherche['id_intervention'];
        ?>
                <tr>
                    <td> <?= $tableauRecherche['date_intervention']; ?></td>
                    <td> <?= $tableauRecherche['type_intervention']; ?></td>
                    <td> <?= $tableauRecherche['etage_intervention']; ?></td>
                    <td><a class="btn btn-danger" href="./delete.php?id=<?= $idsearch ?>">Supprimer l'entrée et revenir à l'accueil</a></td>
                </tr>
            <?php
            }
        }

       else if (isset($_GET['typeIntervention'])) {
            while ($tableauRecherche = $searchrequestType->fetch(PDO::FETCH_ASSOC)) {
                $idsearch = $tableauRecherche['id_intervention'];
            ?>
                <tr>
                    <td> <?= $tableauRecherche['date_intervention']; ?></td>
                    <td> <?= $tableauRecherche['type_intervention']; ?></td>
                    <td> <?= $tableauRecherche['etage_intervention']; ?></td>
                    <td><a class="btn btn-danger" href="./delete.php?id=<?= $idsearch ?>">Supprimer l'entrée et revenir à l'accueil</a></td>
                </tr>

        <?php }
        } ?>

    </tbody>
</table>
<a href="./conciergerie.php" class="btn btn-success">Retour</a>