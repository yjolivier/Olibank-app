<?php 
session_start();
	require "projet/model.php";
	//connexin a la base de donnée
	$bdd = dbConnect();
	//Verification des donnees envoyees
	if (isset($_POST['inscription'])) {

		//protection des donnees avec la fonction htmlspecialchars et password_hash
		$nom = htmlspecialchars($_POST['nom']);
		$prenoms = htmlspecialchars($_POST['prenoms']);
		$email = htmlspecialchars($_POST['email']);
		$email2 = htmlspecialchars($_POST['email2']);
		/*$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);*/
		if (
			!empty($_POST['nom']) AND 
			!empty($_POST['prenoms']) AND 
			!empty($_POST['email']) AND 
			!empty($_POST['email2']) AND 
			!empty($_POST['mdp']) AND 
			!empty($_POST['mdp2'])) 
		{
			if ($email === $email2) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  //Verifions si le mail existe deja ou pas.
					$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail =?");
					$reqmail->execute(array($email));
					$emailexist = $reqmail->rowCount();
					if ($emailexist == 0) {
						//On compare les deux mots de passe
						if ($_POST['mdp'] === $_POST['mdp2']) {
							$mdp = sha1($_POST['mdp']);
							$insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenoms, mail, mdpass, date_inscription) VALUES(?, ?, ?, ?, NOW())");
							$insertmbr->execute(array($nom, $prenoms, $email, $mdp));
							header("location: profile.php?id=".$_SESSION['id']);
						}
						else {
							$erreur = 'Les deux mot de passe sont differents';
						}
					}
					else {
						$erreur = 'L\'adresse mail existe deja';
					}
				}
				else {
					$erreur = 'L\'adresse mail n\'est pas valide';
				}
			}
			else {
				$erreur = "Les adresses mail doivent etre identique !";
			}
		}
		else {
			$erreur = "Veuillez renseigner toutes les informations !";
		}
	}
?>
