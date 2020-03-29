<?php 
	require 'inscription-script.php';
	require 'header.php';
	?>
	<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST" action="inscription-script.php">
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
