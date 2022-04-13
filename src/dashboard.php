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
        $comptes[] = $row;
    }
} else {
    $comptes = null;
}

include "header.php";

?>

<html>
    <div class="container">
        <h1>Votre dashboard <?php echo $_SESSION['username']; ?> !</h1>

        <!-- Début tableaux des comtpes -->
        <?php if($comptes != null){?>
            <h2>Vos comptes</h2>
            <table class="table">
                <tr>
                    <th scope="col">Libellé</th>
                    <th scope="col">Banque</th>
                    <th scope="col">Type</th>
                    <th scope="col">Solde</th>
                </tr>

            <?php foreach ($comptes as $compte) {
                ?>
                <tr>
                    <td style="padding: 5px"><?php echo $compte["libelle"].PHP_EOL; ?></td>
                    <td><?php echo $compte["banque"].PHP_EOL; ?></td>
                    <td><?php echo $compte["id"].PHP_EOL; ?></td>
                    <td><?php echo $compte["solde"].PHP_EOL; ?> €</td>
                </tr>

           <?php }?>
            </table>
        <?php }
        else{
            ?> <div>Aucun compte n'avez pas de comtpes</div>
        <?php }?>
        <!-- Fin tableaux des comtpes -->

    </div>
</html>