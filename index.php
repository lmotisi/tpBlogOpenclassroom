<!DOCTYPE html>
<html>
    <head>
        <title>Blog</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
    </head>
	
	<body>
		<div class="container">
			<h1> Mon super blog ! </h1>
			<p> Derniers billets du blog: </p>
			<div class="news">
			<?php
				try 
				{
					$bdd = new PDO('mysql:host=localhost;dbname=TP;charset=utf8', 'root', '', 
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				} catch (Exception $e) 
				{
					die('Erreur :' . $e->getMessage());
				}
				
				$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM billets ORDER BY id DESC LIMIT 0,5');
				
				while ($donnees = $req->fetch())
				{
				echo 
					'<h3>' . $donnees['titre'] . ' <em>le ' . $donnees['date_creation']. '</em></h3>
					<p>'. $donnees['contenu'] . ' <br/> <a href=commentaires.php?id='.$donnees['id'].'> Commentaires </a> </p>
				';
				}
				
				$req->closeCursor();
			?>
			</div>
		</div>
	
	
	</body>
	
	
	
</html>