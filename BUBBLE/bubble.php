<?php
session_start();
$_SESSION['pseudo'] = $pseudo;
?>
<!DOCTYPE html>
<html lang="fr" id="bubble">
<head>
	<meta charset="utf-8">
	<title>Bubble</title>
	<link rel="stylesheet" type="text/css" href="bubble.css">
</head>
<body>
	<header>
		<h1>BUBBLE</h1>
		<form>
			<input type="search" name="search" placeholder="Rechercher...">
		</form>
	</header>
	<nav>
		<ul>
			<li><a href="profil.php">Profil</a></li>
			<li><a href="abonnes.php">Abonnés</a></li>
			<li><a href="deconnection.php">Déconnexion</a></li>
		</ul>
	</nav>
		<section>
		<article>
			<form method="post" action="bubble_post.php">
				<textarea name="message" rows="2"></textarea>
				<input type="submit" name="send" class="send" value="Envoyer">
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
	<h5><?php echo htmlspecialchars(donnees['pseudo']); ?> a publié :</h5>
	<p><?php echo htmlspecialchars(donnees['message']); ?></p>
<?php	
}
$reponse->closeCursor();
?>
	</article>
	</section>
</body>
</html>