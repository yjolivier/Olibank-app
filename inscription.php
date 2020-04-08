<?php 
session_start();
	require "projet/model.php";
	
	//Verification des donnees envoyees
	if (isset($_POST['inscription'])) {

		//protection des donnees avec la fonction htmlspecialchars et password_hash
		$nom = htmlspecialchars($_POST['nom']);
		$prenoms = htmlspecialchars($_POST['prenoms']);
		$email = htmlspecialchars($_POST['email']);
		$email2 = htmlspecialchars($_POST['email2']);
		$_SESSION['inscrinom'] = $nom;
		$_SESSION['inscriprenoms'] = $prenoms;
		$_SESSION['inscriemail'] = $email;
		$_SESSION['inscriemail2'] = $email2;
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
					$reqmail = SelectUser($email);
					$emailexist = $reqmail->rowCount();
					if ($emailexist == 0) {
						//On compare les deux mots de passe
						if ($_POST['mdp'] === $_POST['mdp2']) {
							$mdp = sha1($_POST['mdp']);
							//insert membre at data base
							MbrInsert($nom, $prenoms, $email, $mdp);
							header("location: index.php");
						}
						else {
							$erreur = 'Les deux mot de passe sont differents';
							$_SESSION['inscrierreur'] = $erreur;
						}
					}
					else {
						$erreur = 'L\'adresse mail existe deja';
						$_SESSION['inscrierreur'] = $erreur;
					}
				}
				else {
					$erreur = 'L\'adresse mail n\'est pas valide';
					$_SESSION['inscrierreur'] = $erreur;
				}
			}
			else {
				$erreur = "Les adresses mail doivent etre identique !";
				$_SESSION['inscrierreur'] = $erreur;
			}
		}
		else {
			$erreur = "Veuillez renseigner toutes les informations !";
			$_SESSION['inscrierreur'] = $erreur;
		}
	}
	require 'header.php';
	require 'projet/view/inscription-view.php';
	require 'footer.php'; 
?>
