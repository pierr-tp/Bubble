<?php
session_start();
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bubbledb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
if (isset($_FILES['file']) AND $_FILES['file']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['file']['size'] <= 8000000)
        {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['file']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . basename($_FILES['file']['name']));
                        echo "L'envoi a bien été effectué !";
                }
                else
                {
                	echo "Le fichier n'est pas une image ou une video !";
                }
        }
        else
        {
        	echo "Le fichier ne doit pas dépasser 8 MO !";
        }
}
else
{

	echo "Erreur";
}
// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO publications (pseudo, message) VALUES(?, ?)');
$req->execute(array($_SESSION['pseudo'], $_POST['message']));

// Redirection du visiteur vers la page du minichat
header('Location: bubble.php');
?>