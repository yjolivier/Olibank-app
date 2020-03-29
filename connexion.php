<?php
session_start();
	require "projet/model.php";
	//connexin a la base de donnée
	$bdd = dbConnect();

	if (isset($_POST['connexion'])) {
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);

		if (!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect'])) {
			if (filter_var($mailconnect, FILTER_VALIDATE_EMAIL)) {
				$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND mdpass = ?");
				$requser->execute(array($mailconnect, $mdpconnect));
				$userexist = $requser->rowCount();
				if ($userexist == 1) {
					$userinfo = $requser->fetch();
					$_SESSION['id'] = $userinfo['id'];
					$_SESSION['email'] = $userinfo['email'];
					$_SESSION['nom'] = $userinfo['nom'];
					$_SESSION['prenoms'] = $userinfo['prenoms'];
					header("location: profile.php?id=".$_SESSION['id']);
				}
				else {
					$erreur = 'Adresse mail ou mot de passe incorrect';
				}
			}
			else {
				$erreur = 'L\'adresse mail est invalide';
			}
		}
		else{
			$erreur = 'Tout les champs doivent être remplient';
		}
	}
?>
