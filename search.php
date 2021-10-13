<?php
 include_once "connect.php";


$rechercheDate = isset($_GET['dateIntervention']) ? $_GET['dateIntervention'] : "'',";
$rechercheType = isset($_GET['typeIntervention']) ? $_GET['typeIntervention'] : '';
$rechercheEtage = isset($_GET['etageIntervention']) ? $_GET['etageIntervention'] :'';

$searchrequestEtage = connect()->query(" SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE etage_intervention = '$rechercheEtage'"); 

$searchrequestType = connect()->query(" SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE type_intervention LIKE '%$rechercheType%'"); 

$searchrequestDate = connect()->query(" SELECT `id_intervention`, `date_intervention`, `type_intervention`, `etage_intervention` 
FROM `intervention` 
WHERE date_intervention = '%$rechercheDate%'"); 






  ?>  
  <table class="table">
            <thead class="table-dark">
                <tr>   
    <th><?= 'Résultat de la recherche: ' ?></th>
    </tr>
    </thead>
            <tbody>
<?php
while ($tableauRecherche = $searchrequestType->fetch(PDO::FETCH_ASSOC)){
    $idsearch = $tableauRecherche['id_intervention'];
   ?>
<tr>
    <td> <?= $tableauRecherche['date_intervention']; ?></td>
    <td> <?= $tableauRecherche['type_intervention']; ?></td>
    <td> <?= $tableauRecherche['etage_intervention']; ?></td>
    <td><a href="./delete.php?id=<?= $idsearch ?>">X</a></td>    
    </tr>

<?php } ?>    </tbody>
        </table>

        <!-- ?php header('location: ./conciergerie.php'); ? -->

