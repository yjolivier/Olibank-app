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
					$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail =?");
					$reqmail->execute(array($email));
					$emailexist = $reqmail->rowCount();
					if ($emailexist == 0) {
						//On compare les deux mots de passe
						if ($_POST['mdp'] === $_POST['mdp2']) {
							$mdp = sha1($_POST['mdp']);
							$insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenoms, mail, mdpass, date_inscription) VALUES(?, ?, ?, ?, NOW())");
							$insertmbr->execute(array($nom, $prenoms, $email, $mdp));
							$_SESSION['id'] =	$bdd->lastInsertId();
							header("location: profile.php?id=".$_SESSION['id']);
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
	?>
	<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST" action="">
							<div class="container-form inscription-form">
								<h1>Inscrivez vous ici</h1>
								<p>Je veux me <a href="connexion.php">connecter</a> j'ai deja un compte <br>
								<?php
									if (isset($_SESSION['inscrierreur'])) {
										echo '<font color="#e32b17">' . $_SESSION['inscrierreur'] . '</font>'; 
									}
								?>
								</p>
								<input class="champdesaisir" type="text" name="nom" placeholder="Nom" value="<?php if(isset($_SESSION['inscrinom'])) { echo $_SESSION['inscrinom']; } ?>"> 
								<br>
								<input class="champdesaisir" type="text" name="prenoms" placeholder="Prenoms" value="<?php if(isset($_SESSION['inscriprenoms'])) { echo $_SESSION['inscriprenoms']; } ?>"> 
								<br>
								<input class="champdesaisir" type="email" name="email" placeholder="Adresse mail" value="<?php if(isset($_SESSION['inscriemail'])) { echo $_SESSION['inscriemail']; } ?>"> 
								<br>
								<input class="champdesaisir" type="email" name="email2" placeholder="Confirmer votre adresse mail" value="<?php if(isset($_SESSION['inscriemail2'])) { echo $_SESSION['inscriemail2']; } ?>"> 
								<br>
								<input class="champdesaisir" type="password" name="mdp" placeholder="Mot de pass"> 
								<br>
								<input class="champdesaisir" type="password" name="mdp2" placeholder="Confirmer le mot de pass"> 
								<br>
								<input class="form-bouton" name="inscription" type="submit" value="S'inscrire" />
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
