﻿<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?php
        require('../../config.php');
        session_start();

        if (isset($_POST['username'])){
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($conn, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            $query = "SELECT * FROM USERS WHERE username='$username' and password='".hash('sha256', $password)."'";
            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $_SESSION['id'] = $row["id"];
                    $_SESSION['username'] = $row["username"];
                    echo "id: " . $row["id"]. " - Name: " . $row["username"]."<br>";
                    header("Location: ../accueil.php");
                                    }
            } else {
                $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
            }

        }
        ?>
    <form class="box" action="" method="post" name="login">
        <h1 class="box-title">Connexion</h1>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion " name="submit" class="box-button">
        <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
        <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
    </form>
</body>
</html>