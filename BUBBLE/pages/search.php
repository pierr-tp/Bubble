<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="search.css">
	<title>Bubble</title>
</head>
<body>
	<header>
		<h1><a href="bubble.php"><div class="bubbletitle">BUBBLE</div></a></h1>
		<form method="post" action="search.php">
			<input type="search" class="search" name="search" placeholder="Rechercher...">
		</form>
	</header>
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bubbledb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->prepare("SELECT id, pseudo FROM members WHERE pseudo = ? ORDER BY ID DESC");
$reponse->execute(array($_POST["search"]));
echo "<ul>";
	while ($donnees = $reponse->fetch()) 
	{	
		?>
		<div class="m1">
		<?php
		echo "<h3>Voici les résultats :</h3>";
		?>
		</div>
		<?php
		?>
		<div class="results">
		<?php
		echo '<h4><strong><a href="profil.php?pseudo='.htmlspecialchars($donnees['pseudo']).'">'.htmlspecialchars($donnees['pseudo']).'</a></strong></h4>';
		?>
		</div>
		<?php	
	}
echo "</ul>";
$reponse->closeCursor();
?>
</body>
</html>
