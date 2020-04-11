<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST">
							<div class="container-form inscription-form">
								<h1>Editer Admin</h1>
								<p><a href="admin.php?id=<?= $_SESSION['adminid'] ?>">annuler</a><br>
								<?php
									if (isset($_SESSION['editerreur'])) {
										echo '<font color="#e32b17">' . $_SESSION['editerreur'] . '</font>'; 
									}
								?>
								</p>
								<input class="champdesaisir" type="text" name="nom" placeholder="Nom" value="<?php if(isset($_SESSION['editnom'])) { echo $_SESSION['editnom']; } ?>"> 
								<br>
								<input class="champdesaisir" type="text" name="contacte" placeholder="Contacte" value="<?php if(isset($_SESSION['editcontacte'])) { echo $_SESSION['editcontacte']; } ?>"> 
								<br>
								<input class="champdesaisir" type="email" name="email" placeholder="Adresse mail" value="<?php if(isset($_SESSION['editemail'])) { echo $_SESSION['editemail']; } ?>"> 
								<br>
								<input class="champdesaisir" type="email" name="email2" placeholder="Confirmer votre adresse mail" value="<?php if(isset($_SESSION['editemail2'])) { echo $_SESSION['editemail2']; } ?>"> 
								<br>
								<input class="champdesaisir" type="password" name="mdp" placeholder="Mot de pass"> 
								<br>
								<input class="champdesaisir" type="password" name="mdp2" placeholder="Confirmer le mot de pass"> 
								<br>
								<input class="form-bouton" name="editer" type="submit" value="modifier" />
							</div>
						</form>
					</div>
					<div class="card-right col-lg-6 col-md-6 col-sm-12 ">
					</div>
				</div>
			</div>
		</div>
</body>