<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
require 'header.php'; ?>
	<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST" action="connexion.php">
							<div class="container-form">
								<h1>Connectez vous ici</h1>
								<input class="champdesaisir" type="email" name="mailconnect" placeholder="Adresse mail"> <br>
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
