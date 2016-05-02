<!DOCTYPE html>
<html>
    <head>
        <title>Commentaires</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
    </head>
	
	<body>
		<div class="container">
			<h1> Mon super blog ! </h1>
			<p> <a href="index.php"> Retour à la liste des billets </a> </p>
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
				
				$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d%m%Y & %Hh%imin%ss\') AS date_creation FROM billets WHERE id= ?');
				$req->execute(array($_GET['id']));
				
				if($donnees=$req->fetch())
				{
					echo'
						<h3>' . $donnees['titre'] . ' <em>le ' . $donnees['date_creation']. '</em></h3>
						<p>'. $donnees['contenu'] . '  </p>
					';
				}
				
				$req->closeCursor();
			?>
			</div>
				
			<div class="commentaires">
				<h2> Commentaires </h2>
				<?php
				$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire FROM commentaires WHERE id_billet= ? ORDER BY date_commentaire');
				$req->execute(array($_GET['id']));
				
				while($donnees=$req->fetch()) 
				{
					echo '
						<p><strong>' . $donnees['auteur'] . '</strong> <em>le ' . $donnees['date_commentaire'] . '</em> : </p>
						<p>' . $donnees['commentaire'] . '</p>
					';
					
				}
				
				$req->closeCursor();
				
				?>
			</div>
		</div>
	</body>
</html>
	