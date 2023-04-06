<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bubble_start.css">
	<title>Bubble</title>
</head>
<body>
	<div class="body2">
	<h1>Bonjour <?php echo $_SESSION['pseudo']; ?>.</h1>
	<h4>Bienvenue sur Bubble. Suivez ces étapes pour débuter.</h4>
	<form method="action" action="profil.php">
		<input type="submit" name="bstart" value="Commencer">
	</form>
	</div>
</body>
</html>