
<?php 
include 'connect.php';

?>
<h4>Conciergerie</h4>
<?php if (isset($_GET['id'])) { 
    $id = $_GET['id'];
    $intervention = connect()->query("SELECT * FROM `intervention` WHERE id_intervention = $id");
    var_dump($intervention);
    echo "<br/>";
    $intervention->fetch(PDO::FETCH_OBJ);
    var_dump($intervention);
    var_dump($id);
    var_dump($intervention->date_intervention);
    ?>


        <form class="row g-3" action="./create.php" method="POST">
        <input type="text" value="<?= $id ?>">
            <input type="date" class="form-control" name="dateIntervention" value="<?= $intervention->date_intervention; ?>" required id="dateIntervention">
            <select type="select" class="form-select form-select" name="typeIntervention" value="<?= $intervention->type_intervention; ?>" required id="typeIntervention">
                <option value="Remplacer serrure">Remplacer serrure</option>
                <option value="Passer le balais">Passer le balais</option>
                <option value="Sortir les poubelles">Sortir les poubelles</option>
                <option value="Changer ampoule">Changer ampoule</option>
                <option value="Nettoyer vitres">Nettoyer vitres</option>
                <option value="Guetter les allées venues">Gueter les allées & venues</option>
            </select>
            <select type="select" class="form-select form-select" name="etageIntervention" value="<?= $intervention->etage_intervention; ?>" required id="etageIntervention">
                <option value="1">RDC</option>
                <option value="2">1</option>
                <option value="3">2</option>
                <option value="4">3</option>
                <option value="5">4</option>
                <option value="6">5</option>
            </select>
            <button type="submit" class="btn btn-warning">Modifier tâche</button>
        </form>


<?php 
// else if (!empty($_POST['dateIntervention']) && !empty($_POST['typeIntervention']) && !empty($_POST['etageIntervention']))
// if (isset($_GET['id']) && (!empty($_POST['dateIntervention']) && !empty($_POST['typeIntervention']) && !empty($_POST['etageIntervention'])){
//     $sth = connect()->prepare('UPDATE intervention SET date_intervention=:date_intervention, type_intervention=:type_intervention,etage_intervention=:etage_intervention)
// VALUES (:date_intervention,:type_intervention:etage_intervention)');
//             $sth->execute(array(
//                 ':date_intervention' => $_POST['dateIntervention'],
//                 ':type_intervention' => $_POST['typeIntervention'],
//                 ':etage_intervention' => $_POST['etageIntervention']
//             ));
} 



?>