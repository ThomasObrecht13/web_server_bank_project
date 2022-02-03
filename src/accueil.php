<?php
session_start();
require('../config.php');

//Get userID
$userId = $_SESSION['id'];

//Get all comptes link to user
$query = "SELECT * FROM COMPTES WHERE userId = ".$userId;
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $compte[] = $row;
    }
} else {
    $compte = null;
}

//Form to add comptes
if (isset($_REQUEST['libelle'], $_REQUEST['banque'], $_REQUEST['solde'])) {
    //Todo: filtrer les entrées

    // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
    $libelle = stripslashes($_REQUEST['libelle']);
    $libelle = mysqli_real_escape_string($conn, $libelle);
    // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
    $banque = stripslashes($_REQUEST['banque']);
    $banque = mysqli_real_escape_string($conn, $banque);
    // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
    $solde = stripslashes($_REQUEST['solde']);
    $solde = mysqli_real_escape_string($conn, $solde);

    //requéte SQL + mot de passe crypté
    echo "INSERT into COMPTES (libelle, banque, solde, userId)
              VALUES ('$libelle', '$banque', '$solde', $userId)";
    $query = "INSERT into COMPTES (libelle, banque, solde, userId)
              VALUES ('$libelle', '$banque', '$solde', $userId)";
// Exécute la requête sur la base de données
    $result = $conn->query($query);
    if ($result) {
        $messageAjout = "comtpe ajouter";
    }else{
        $messageAjout = "Une erreur c'est produite";
    }
}


?>
<html>
    <div class="sucess">
        <h1>Bienvenue <?php echo $_SESSION['username']; ?> !</h1>
        <form action="" method="post" name="addComtpe">
            <h1>Ajouter un comptes</h1>
            <input type="text" name="libelle" placeholder="Libelle">
            <input type="text" name="banque" placeholder="Banque">
            <input type="text" name="solde" placeholder="Solde">
            <input type="submit" value="Ajouter" name="submit">
            <?php if (! empty($messageAjout)) { ?>
                <p class="errorMessage"><?php echo $messageAjout; ?></p>
            <?php } ?>
        </form>

        <?php if($compte != null){?>
            <h2>Vos comptes</h2>
            <table border="1"
                <tr>
                    <th>Libellé</th>
                    <th>Banque</th>
                    <th>Type</th>
                    <th>Solde</th>
                </tr>

            <?php foreach ($compte as $item) {
                ?>
                <tr>
                    <th style="padding: 5px"><?php echo $item["libelle"].PHP_EOL; ?></th>
                    <th><?php echo $item["banque"].PHP_EOL; ?></th>
                    <th><?php echo $item["id"].PHP_EOL; ?></th>
                    <th><?php echo $item["solde"].PHP_EOL; ?></th>
                </tr>

           <?php }?>
            </table>
        <?php }
        else{
            ?> <div>Aucun compte n'avez pas de comtpes</div>
        <?php }?>

        <a href="./registration/logout.php">Déconnexion</a>
    </div>
</html>