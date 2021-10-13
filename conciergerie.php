<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Conciergerie</title>
</head>
<style>
a{text-decoration: none;
color: inherit;}
a:hover{color:  #abb2b9 ;}
    svg{
        transition: .3s;
    }
    svg:hover{
        fill: red;
    }
    .edit-icon:hover{
        fill:limegreen;
    }
</style>
<body>
    <div class="container">
        <div class="container">
        <h4>Conciergerie</h4>
        <form class="row g-3" action="./create.php" method="POST">
            <input type="date" class="form-control" name="dateIntervention" value="<?= date("Y-m-d") ?>" required id="dateIntervention">
            <select type="select" class="form-select form-select" name="typeIntervention" required id="typeIntervention">
                <option value="Remplacer serrure">Remplacer serrure</option>
                <option value="Passer le balais">Passer le balais</option>
                <option value="Sortir les poubelles">Sortir les poubelles</option>
                <option value="Changer ampoule">Changer ampoule</option>
                <option value="Nettoyer vitres">Nettoyer vitres</option>
                <option value="Guetter les allées venues">Gueter les allées & venues</option>
            </select>
            <select type="select" class="form-select form-select" name="etageIntervention" required id="etageIntervention">
                <option value="1">RDC</option>
                <option value="2">1</option>
                <option value="3">2</option>
                <option value="4">3</option>
                <option value="5">4</option>
                <option value="6">5</option>
            </select>
            <button type="submit" class="btn btn-warning">Ajouter tâche</button>
        </form>
        <a href="./conciergerie.php" class="btn btn-info">Mettre à jour la liste</a>

</div>
        <?php
        include_once "connect.php";


        $basesql = "SELECT * FROM `intervention`";

        if (isset($_GET['date'])){
            $basesql .="ORDER BY `date_intervention` ASC";
        }
        else if (isset($_GET['inter'])){
            $basesql .="ORDER BY `type_intervention` ASC";
        }
        else if (isset($_GET['etage'])){
            $basesql .="ORDER BY `etage_intervention` ASC";
        }
        
        else {
            $basesql .="ORDER BY id_intervention DESC";
        }
        
        


        $intervention = connect()->query($basesql);
        ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th colspan="1"><a href="./conciergerie.php?date=1">Date</a></th>
                    <th colspan="1"><a href="./conciergerie.php?inter=1">Interventions</a></th>
                    <th colspan="1"><a href="./conciergerie.php?etage=1">Etages</a></th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($tableau = $intervention->fetch(PDO::FETCH_OBJ)) {
                    $idinterv = $tableau->id_intervention;
                ?>
                    <tr>
                        <td><?= $tableau->date_intervention; ?></td>
                        <td><?= $tableau->type_intervention; ?></td>
                        <td><?= $tableau->etage_intervention; ?></td>
                        <td><a href="./edit.php?id=<?= $idinterv ?>"><svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M3,21l3.75,0L17.81,9.94l-3.75-3.75L3,17.25L3,21z M5,18.08l9.06-9.06l0.92,0.92L5.92,19L5,19L5,18.08z"/></g><g><path d="M18.37,3.29c-0.39-0.39-1.02-0.39-1.41,0l-1.83,1.83l3.75,3.75l1.83-1.83c0.39-0.39,0.39-1.02,0-1.41L18.37,3.29z"/></g></g></g></svg></a></td>
                        <td><a href="./delete.php?id=<?= $idinterv ?>" ><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#00c657"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
</a></td>
                    </tr>
                <?php
                }                
                ?>
            </tbody>
        </table>
        <?php

        if (!empty($_POST['dateIntervention']) && !empty($_POST['typeIntervention']) && !empty($_POST['etageIntervention'])) {
            $sth = connect()->prepare('INSERT INTO intervention(date_intervention,type_intervention,etage_intervention)
VALUES (:date_intervention,:type_intervention,:etage_intervention)');
            $sth->execute(array(
                ':date_intervention' => $_POST['dateIntervention'],
                ':type_intervention' => $_POST['typeIntervention'],
                ':etage_intervention' => $_POST['etageIntervention']
            ));
            echo "Entrée ajoutée dans la table";
        }
        ?>
   



    <form action="./search.php" method="GET">
            <input type="date" class="form-select form-select" name="dateIntervention"  id="dateIntervention">
            <button type="submit" class="btn btn-success">Rechercher la date</button>
        </form>
        <form action="./search.php"  method="GET">
            <select type="select" class="form-select form-select" name="typeIntervention" id="typeIntervention">
                <option value="Remplacer serrure">Remplacer serrure</option>
                <option value="Passer le balais">Passer le balais</option>
                <option value="Sortir les poubelles">Sortir les poubelles</option>
                <option value="Changer ampoule">Changer ampoule</option>
                <option value="Nettoyer vitres">Nettoyer vitres</option>
                <option value="Guetter les allées venues">Gueter les allées & venues</option>
            </select>
            <button type="submit" class="btn btn-success">Rechercher le type d'intervention</button>
        </form>
        <form action="./search.php" method="GET">
            <select type="select" class="form-select form-select" name="etageIntervention" id="etageIntervention">
                <option value="1">RDC</option>
                <option value="2">1</option>
                <option value="3">2</option>
                <option value="4">3</option>
                <option value="5">4</option>
                <option value="6">5</option>
            </select>
            <button type="submit" class="btn btn-success">Rechercher l'étage</button>
        </form>
         
        <?php include "search.php" ?>

 </div>
</body>

</html>