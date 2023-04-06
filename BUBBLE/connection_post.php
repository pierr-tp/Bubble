<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bubbledb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$pseudo = $_POST['pseudo'];
$pass_hache = sha1($_POST['password']);
$req = $bdd->prepare('SELECT id FROM members WHERE pseudo = :pseudo AND password = :password');
$req->execute(array(
    'pseudo' => $pseudo,
    'password' => $pass_hache));

$resultat = $req->fetch();

if (!$resultat)
{
?>  <!DOCTYPE html>
    <html lang="fr" id="bubble">
    <head>
        <meta charset="utf-8">
    <title>!</title>
    <link rel="stylesheet" type="text/css" href="!.css">
    </head>
    <body>
        <p>Mauvais identifiant ou mot de passe !</p>
        <form method="post" action="formulaire_connection.html">
            <input type="submit" name="b1" class="b1" value="OK">
        </form>
    </body>
    </html>
<?php
}
else
{
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $pseudo;
    header('Location: bubble.php');
}
?>