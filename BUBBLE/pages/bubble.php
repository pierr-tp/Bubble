<?php
session_start();
if (!empty($_SESSION['id']))
{
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bubble1.css">
	<title>Bubble</title>
</head>
<body>
	<header>
		<h1><a href="bubble.php">BUBBLE</a></h1>
		<form method="post" action="search.php">
			<input type="search" class="search" name="search" placeholder="Rechercher...">
		</form>
	</header>
	<nav>
		<ul>
			<li><a href="profil.php">Profil</a></li>
			<li><a href="sujet.php">Sujet</a></li>
			<li><a href="forum.php">Forum</a></li>
			<li><a href="deconnection.php">Déconnexion</a></li>
		</ul>
	</nav>
	<section>
		<article>
			<form method="post" action="bubble_post.php" enctype="multipart/form-data">
				<div class="zonepublis">
				<textarea name="message" rows="2"></textarea>
				<input type="file" name="file">
				<input type="submit" name="send" class="send" value="Envoyer">
				</div>
			</form>
		</article>
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
			$reponse = $bdd->query('SELECT pseudo, message FROM publications ORDER BY ID DESC');
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
<?php
}
else
{
	header('Location: bubbleaccueil.html');
}
?>
