<?php require 'header.php'; ?>
	<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST" action="secret.php">
						<div class="container-form inscription-form">
							<h1>Inscrivez vous ici</h1>
              <input class="champdesaisir" type="text" name="nom" placeholder="Nom"> <br>
              <input class="champdesaisir" type="text" name="prenoms" placeholder="Prenoms"> <br>
              <input class="champdesaisir" type="text" name="pseudo" placeholder="Pseudonyme"> <br>
              <input class="champdesaisir" type="password" name="motdepasse" placeholder="Mot de pass"> <br>
              <input class="champdesaisir" type="password" name="motdepasse" placeholder="Confirmer le mot de pass"> <br>
							<input class="form-bouton" name="btn" type="submit" value="Se connecter" />
							<p>Je veux me <a href="connexion.php">connecter</a> j'ai deja un compte</p>
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
