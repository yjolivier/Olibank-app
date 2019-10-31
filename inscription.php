<?php 
session_start();
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=olibank;charset=utf8', 'root', '');
	}
	catch (Exception $e) {
	  die('Erreur : ' . $e->getMessage());
	} 
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
<?php 	require 'header.php'; ?>
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
									if (isset($erreur)) {
										echo '<font color="#e32b17">' . $erreur . '</font>'; 
									}
								?>
								</p>
								<input class="champdesaisir" type="text" name="nom" placeholder="Nom" value="<?php if(isset($nom)) { echo $nom; } ?>"> 
								<br>
								<input class="champdesaisir" type="text" name="prenoms" placeholder="Prenoms" value="<?php if(isset($prenoms)) { echo $prenoms; } ?>"> 
								<br>
								<input class="champdesaisir" type="email" name="email" placeholder="Adresse mail" value="<?php if(isset($email)) { echo $email; } ?>"> 
								<br>
								<input class="champdesaisir" type="email" name="email2" placeholder="Confirmer votre adresse mail" value="<?php if(isset($email2)) { echo $email2; } ?>"> 
								<br>
								<input class="champdesaisir" type="password" name="mdp" placeholder="Mot de pass"> 
								<br>
								<input class="champdesaisir" type="password" name="mdp2" placeholder="Confirmer le mot de pass"> 
								<br>
								<input class="form-bouton" name="inscription" type="submit" value="Se connecter" />
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
