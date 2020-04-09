<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST" action="">
							<div class="container-form inscription-form">
								<h1>Inscrivez vous ici</h1>
								<p>Je veux me <a href="index.php">connecter</a> j'ai deja un compte <br>
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
