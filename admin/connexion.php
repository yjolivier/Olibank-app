<?php
session_start();
	require "../projet/model.php";
	//connexin a la base de donnée
	$bdd = dbConnect();

	if (isset($_POST['connexionadmin'])) {
		$mailadmin = htmlspecialchars($_POST['mailadmin']);
		$mdpadmin = sha1($_POST['mdpadmin']);

		if (!empty($_POST['mailadmin']) AND !empty($_POST['mdpadmin'])) {
			if (filter_var($mailadmin, FILTER_VALIDATE_EMAIL)) {
				$requser = $bdd->prepare("SELECT * FROM administrateur WHERE mail = ? AND motdepass = ?");
				$requser->execute(array($mailadmin, $mdpadmin));
				$userexist = $requser->rowCount();
				if ($userexist == 1) {
					$userinfo = $requser->fetch();
					$_SESSION['adminid'] = $userinfo['id'];
						header("location: profile-admin.php?id=".$_SESSION['id']);
				}
				else {
					$erreur = 'Adresse mail ou mot de passe incorrect';
					$_SESSION['erreur'] = $erreur;
					header("location: index.php");
				}
			}
			else {
				$erreur = 'L\'adresse mail est invalide';
				$_SESSION['erreur'] = $erreur;
				header("location: index.php");
			}
		}
		else{
			$erreur = 'Tout les champs doivent être remplient';
			$_SESSION['erreur'] = $erreur;
			header("location: index.php");
		}
	}
?>
