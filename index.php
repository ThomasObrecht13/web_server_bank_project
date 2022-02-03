<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])) {
        header("Location: ./src/registration/login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
	</body>
</html>