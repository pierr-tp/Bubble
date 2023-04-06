<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bubbledb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
if (!empty($_POST['pseudo']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['genre']) and !empty($_POST['date']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$genre = htmlspecialchars($_POST['genre']);
	$date = htmlspecialchars($_POST['date']);

	$req1 = $bdd->query('SELECT COUNT(*) AS existe_pseudo FROM members WHERE pseudo = "'.$_POST['pseudo'].'"');

	while ($sql1 = $req1->fetch()) 
	{
		if ($sql1['existe_pseudo'] == '0')
		{
			$req2 = $bdd->query('SELECT COUNT(*) AS existe_email FROM members WHERE email = "'.$_POST['email'].'"');
			while ($sql2 = $req2->fetch()) 
			{
				if ($sql2['existe_email'] == '0')
				{
					if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'] ))
					{
						$pass_hache = sha1($_POST['password']);
						$req3 = $bdd->query('SELECT COUNT(*) AS existe_password FROM members WHERE password = "'.$pass_hache.'"');

						while ($sql3 = $req3->fetch()) 
						{
							if ($sql3['existe_password'] == '0')
							{
								$req = $bdd->prepare('INSERT INTO members(pseudo, email, password, genre, date, date_inscription) VALUES(:pseudo, :email, :password, :genre,:date, CURDATE())');
								$req->execute(array(
								    'pseudo' => $pseudo,
								    'email' => $email,
									'password' => $pass_hache,
									'genre' => $genre,
									'date' => $date));
								session_start();
								$_SESSION['pseudo'] = $pseudo;
								$_SESSION['email'] = $email;
								$_SESSION['password'] = $pass_hache;
								$_SESSION['genre'] = $genre;
								$_SESSION['date'] = $date;
?>
								<!DOCTYPE html>
								<html lang="fr" id="bubble">
								<head>
									<meta http-equiv="refresh" content="1; URL=bubble_start.php">
									<link rel="stylesheet" type="text/css" href="bienvenue.css">
									<title>Bubble</title>
								</head>
								<body>
									<h1>Bienvenue</h1>
								</body>
								</html>
<?php
							}
							else
							{
?>								<!DOCTYPE html>
								<html lang="fr" id="bubble">
								<head>
									<title>!</title>
									<link rel="stylesheet" type="text/css" href="!.css">
								</head>
								<body>
									<p>Desole ! Ce mot de passe est deja pris.</p>
									<form method="post" action="formulaire_inscription.html">
										<input type="submit" name="b1" value="OK" class="b1">
									</form>
								</body>
								</html>
<?php
							}
						}	
					}
					else
					{
?>						<!DOCTYPE html>
						<html lang="fr" id="bubble">
						<head>
							<title>!</title>
							<link rel="stylesheet" type="text/css" href="!.css">
						</head>
						<body>
							<p>Cet email est incorrecte !</p>
							<form method="post" action="formulaire_inscription.html">
								<input type="submit" name="b1" value="OK" class="b1">
							</form>
						</body>
						</html>
<?php	
					}
				}
				else
				{
?>					<!DOCTYPE html>
					<html lang="fr" id="bubble">
					<head>
						<title>!</title>
						<link rel="stylesheet" type="text/css" href="!.css">
					</head>
					<body>
						<p>Cet email existe deja !</p>
						<form method="post" action="formulaire_inscription.html">
							<input type="submit" name="b1" value="OK" class="b1">
						</form>
					</body>
					</html>
<?php		
				}
			}	
		}
		else
		{
?>			<!DOCTYPE html>
			<html lang="fr" id="bubble">
			<head>
				<title>!</title>
				<link rel="stylesheet" type="text/css" href="!.css">
			</head>
			<body>
				<p>Desole ! Ce pseudo est deja pris.</p>
				<form method="post" action="formulaire_inscription.html">
					<input type="submit" name="b1" value="OK" class="b1">
				</form>
			</body>
			</html>
<?php
		}
	}	
}

else
{
?>	<!DOCTYPE html>
	<html lang="fr" id="bubble">
	<head>
		<title>!</title>
		<link rel="stylesheet" type="text/css" href="!.css">
	</head>
	<body>
		<p>Vous devez remplir le formulaire !</p>
		<form method="post" action="formulaire_inscription.html">
			<input type="submit" name="b1" value="OK" class="b1">
		</form>
	</body>
	</html>
<?php
}
?>