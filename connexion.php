<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

//Connexion a la base de donnee
try {
	$bdd = new PDO('mysql:host=localhost;dbname=olibank;charset=utf8', 'root', '');
}
catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['connexion'])) {
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = password_hash($_POST['mdpconnect'], PASSWORD_DEFAULT);

	if (!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect'])) {
		if (filter_var($mailconnect, FILTER_VALIDATE_EMAIL)) {
			$requser = $bdd->prepare("SELECT * FROM membres WHERE email = ? AND mdpass = ?");
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

<?php require 'header.php'; ?>
	<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST" action="">
						<div class="container-form">
							<h1>Connectez vous ici</h1>
							<input class="champdesaisir" type="text" name="mailconnect" placeholder="Adresse mail"> <br>
							<input class="champdesaisir" type="password" name="mdpconnect" placeholder="Password"> <br>
							<input class="form-bouton" name="connexion" type="submit" value="Se connecter" />
							<p>
								Je veux creer <a href="inscription.php">un compte</a><br>
								<?php
									if (isset($erreur)) {
										echo '<br><font color="red">' . $erreur . '</font>';
									}
								?>
							</p>
						</div>
				</form>
					</div>
					<div class="card-right col-lg-6 col-md-6 col-sm-12 ">
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php require 'footer.php'; ?>
</html>
