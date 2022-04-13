<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<?php
session_start();

$userId = $_SESSION['id'];
require('../config.php');

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
    $query = "INSERT into COMPTES (libelle, banque, solde, userId)
              VALUES ('$libelle', '$banque',     '$solde', $userId)";
// Exécute la requête sur la base de données
    $result = $conn->query($query);
    if ($result) {
        $messageAjout = "comtpe ajouter";
        sleep(2);
        header("Location: dashboard.php");
    }else{
        $messageAjout = "Une erreur c'est produite";
    }
}

include "header.php"
?>
<body>
<div class="container">
    <!-- Début formulaire ajout compte -->
    <form class="row gx-3 gy-2 align-items-center" action="" method="post" name="addComtpe">
        <legend>Ajouter un compte</legend>

        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputName">Libelle</label>
            <input type="text" class="form-control" name="libelle" placeholder="Libelle">
        </div>

        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputName">banque</label>
            <input type="text" class="form-control" name="banque" placeholder="banque">
        </div>

        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputName">solde</label>
            <input type="text" class="form-control" name="solde" placeholder="solde">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
        <?php if (! empty($messageAjout)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $messageAjout; ?>
            </div>
        <?php } ?>
    </form>
</div>
    <!-- Fin formulaire ajout compte -->
</body>
</html>