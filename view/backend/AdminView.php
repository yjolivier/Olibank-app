	<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST">
							<div class="container-form">
								<h1>Connexion admin</h1>
								<input class="champdesaisir" type="email" name="mailadmin" placeholder="Adresse mail"> <br>
								<input class="champdesaisir" type="password" name="mdpadmin" placeholder="Password"> <br>
								<input class="form-bouton" name="connexionadmin" type="submit" value="Se connecter" />
								<p>
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