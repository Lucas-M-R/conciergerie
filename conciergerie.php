<?php 
include "header.php";
session_start();


$name = $_SESSION['name'];
if(isset($_SESSION['logged'])){
    ?><div class="container-fluid "><h4>Bonjour <?=$name?></h4>
    <a class="btn btn-danger" href="./logout.php">Se déconnecter</a>
      </div>
<?php
}
else{
    header("Location: ./login.php");
}
// ?>





<body>
    <div class="container  p-2"><h1 class="d-flex justify-content-center">Conciergerie</h1>
        <div class="container d-flex justify-content-evenly p-2">
        
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
        else if (isset($_GET['datedesc'])){
            $basesql .="ORDER BY `date_intervention` DESC";
        }
        else if (isset($_GET['interdesc'])){
            $basesql .="ORDER BY `type_intervention` DESC";
        }
        else if (isset($_GET['etagedesc'])){
            $basesql .="ORDER BY `etage_intervention` DESC";
        }        
        else {
            $basesql .="ORDER BY id_intervention DESC";
        }
    
        $intervention = connect()->query($basesql);
        ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th colspan="1" >Date
                        <a href="./conciergerie.php?date=1"><svg class="iconOrder" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="24px" fill="#abb2b9 "><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/></svg></a>
                        <a href="./conciergerie.php?datedesc=1"><svg class="iconOrder" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="24px" fill="#abb2b9 "><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg></a>
                    </th>
                    <th colspan="1">Interventions
                        <a href="./conciergerie.php?inter=1"><svg class="iconOrder" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="24px" fill="#abb2b9 "><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/></svg></a>
                        <a href="./conciergerie.php?interdesc=1"><svg class="iconOrder" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="24px" fill="#abb2b9 "><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg></a>
                    </th>
                    <th colspan="1">Etages
                        <a href="./conciergerie.php?etage=1"><svg class="iconOrder" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="24px" fill="#abb2b9 "><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/></svg></a>
                        <a href="./conciergerie.php?etagedesc=1"><svg class="iconOrder" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="24px" fill="#abb2b9 "><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg></a>
                    </th>
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
                        <td><a href="./delete.php?id=<?= $idinterv ?>" ><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#00c657"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg></a></td>
                    </tr>
                <?php
                }                
                ?>
            </tbody>
        </table>
        <a href="./conciergerie.php" class="btn btn-info">Mettre à jour la liste</a>

        <?php

        // if (!empty($_POST['dateIntervention']) && !empty($_POST['typeIntervention']) && !empty($_POST['etageIntervention'])) {
        //     $sth = connect()->prepare('INSERT INTO intervention(date_intervention,type_intervention,etage_intervention)
        // VALUES (:date_intervention,:type_intervention,:etage_intervention)');
        //     $sth->execute(array(
        //         ':date_intervention' => $_POST['dateIntervention'],
        //         ':type_intervention' => $_POST['typeIntervention'],
        //         ':etage_intervention' => $_POST['etageIntervention']
        //     ));
        //     echo "Entrée ajoutée dans la table";
        // }

        if (!empty($_POST['dateIntervention']) && !empty($_POST['typeIntervention']) && !empty($_POST['etageIntervention'])) {
            $sth = connect()->prepare('INSERT INTO intervention(date_intervention,type_intervention,etage_intervention)
        VALUES (?, ?, ?)');
            $sth->execute(array(
                $_POST['dateIntervention'],
                $_POST['typeIntervention'],
                $_POST['etageIntervention']
            ));
            echo "Entrée ajoutée dans la table";
        }
        ?>

<div class="container d-flex justify-content-evenly p-2">
    <form action="./search.php" method="GET">
            <input type="date" class="form-select form-select" name="dateIntervention" value="<?= date("Y-m-d") ?>" id="dateIntervention">
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
         </div> 
 </div>
</body>
</html>