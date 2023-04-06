<?php
require "includes/connect_db.php";

if (!empty($_POST['pseudo_check'])) {
	$pseudo = $_POST['pseudo_check'];
	$pseudo = htmlspecialchars($_POST['pseudo']);
	if (strlen($pseudo) <2) {
		echo '<br/>Votre pseudo doit contenir au moins 2 carcatères .';
		exit();
	}
	$req1 = $bdd->query('SELECT COUNT(*) AS existe_pseudo FROM members WHERE pseudo = "'.$_POST['pseudo'].'"');
	while ($sql1 = $req1->fetch()) 
	{
		if ($sql1['existe_pseudo'] == '0'){
			echo "success";
			exit();
		}
		else{
			echo'<br/>Désolé, ce pseudo est déjà utilisé .';
			exit();
		}
	}
		
}
?>