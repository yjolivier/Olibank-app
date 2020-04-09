<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST">
							<div class="container-form">
								<h1>Connectez vous ici</h1>
								<input class="champdesaisir" type="email" name="mailconnect" placeholder="Adresse mail"> <br>
								<input class="champdesaisir" type="password" name="mdpconnect" placeholder="Password"> <br>
								<input class="form-bouton" name="connexion" type="submit" value="Se connecter" />
								<p>
									Voulez vous creer <a href="index.php?action=inscription">un compte</a> ou est ce que vous etes <a href="index.php?action=admin">Administrateur</a>
									<?php
										if (isset($_SESSION['erreur'])) {
											echo '<br><font color="red">' . $_SESSION['erreur'] . '</font>';
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