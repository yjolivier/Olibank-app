<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

//connexionadmin a la base de donnee
try {
	$bdd = new PDO('mysql:host=localhost;dbname=olibank;charset=utf8', 'root', '');
}
catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['connexionadmin'])) {
	$mailconnectadmin = htmlspecialchars($_POST['mailconnectadmin']);
	$mdpconnectadmin = sha1($_POST['mdpconnectadmin']);

	if (!empty($_POST['mailconnectadmin']) AND !empty($_POST['mdpconnectadmin'])) {
		if (filter_var($mailconnectadmin, FILTER_VALIDATE_EMAIL)) {
			$requser = $bdd->prepare("SELECT * FROM admin WHERE mail = ? AND motdepass = ?");
			$requser->execute(array($mailconnectadmin, $mdpconnectadmin));
			$userexist = $requser->rowCount();
			if ($userexist == 1) {
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['email'] = $userinfo['email'];
				$_SESSION['nom'] = $userinfo['nom'];
				$_SESSION['prenoms'] = $userinfo['prenoms'];
				header("location: profile-admin.php?id=".$_SESSION['id']);
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
							<h1>Administrateur</h1>
							<input class="champdesaisir" type="email" name="mailconnectadmin" placeholder="Adresse mail"> <br>
							<input class="champdesaisir" type="password" name="mdpconnectadmin" placeholder="Password"> <br>
							<input class="form-bouton" name="connexionadmin" type="submit" value="Se connecter" />
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
