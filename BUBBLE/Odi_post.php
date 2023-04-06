<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Odi_post.css">
	<title>Odi</title>
</head>
<body>
<p>
<?php
$answer = htmlspecialchars($_POST["answer"]);

if (preg_match("#\.$#", $answer)) 
{
		
}
elseif (preg_match("#\?$#", $answer)) 
{
	if(preg_match("#Quel|Quelle|Quelles|Quel#i", $answer))
	{
		if (preg_match("#date|mois|jour#i", $answer)) 
		{
			$date = date("d/m/Y");
			$heure = date("H:i");
			echo "Nous sommes le $date et il est $heure";	
		}
		elseif (preg_match("#heure|minute|seconde|microseconde#i", $answer)) 
		{
			$heure = date("H:i:s");
			echo "Il est $heure";	
		}
	}	
}
else
{
	echo "Je ne comprends pas .";
}
?>
</p>
</body>
</html>


