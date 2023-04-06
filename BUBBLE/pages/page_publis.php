<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="profil1.css">
	<title>Bubble</title>
</head>
<body>
	<header>
		<h1><a href="bubble.php">BUBBLE</a></h1>
		<form method="post" action="search.php">
			<input type="search" class="search" name="search" placeholder="Rechercher...">
		</form>
	</header>
	<img src="p.png">
	<h2><?php echo $_SESSION['pseudo']; ?></h2>
	<nav>
		<ul>
			<div id="menu">
				<div class="element1"><li><a href="profil.php">Tous</a></li></div>
				<div class="element2"><li><a href="informations_profil.php">Informations</a></li></div>
				<div class="element3"><li><a href="page_publis">Publications</a></li></div>
				<div class="element4"><li><a href="modifier_profil">Modifier</a></li></div>
			</div>
		</ul>
	</nav>
	<section>
		<article>
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=bubbledb;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
			        die('Erreur : '.$e->getMessage());
			}
			$reponse = $bdd->prepare('SELECT pseudo, message FROM publications  WHERE pseudo = ? ORDER BY ID DESC');
			$reponse->execute(array($_SESSION["pseudo"]));
			while ($donnees = $reponse->fetch())
			{
			?>
		<div class="publis">
			<?php
			echo '<h4><strong>'.htmlspecialchars($donnees['pseudo']).'</strong></h4>';
			echo '<p>'.htmlspecialchars($donnees['message']).'</p>';
			?>
		</div>
			<?php
			}
			$reponse->closeCursor();
			?>
		</article>
	</section>
</body>
</html>