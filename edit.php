<?php 
session_start();
	require "model/model.php";
	//connexin a la base de donnée
  $bdd = dbConnect();
  if(isset($_GET['id']) AND $_GET['id'] > 0){
    //Convertir l'id en nombre
	  $getid = intval($_GET['id']);
	  $requser = $bdd->query("SELECT * FROM membres WHERE id = $getid");
    $userinfo = $requser->fetch();
    $_SESSION['editnom'] = $userinfo['nom'];
    $_SESSION['editprenoms'] = $userinfo['prenoms'];
    $_SESSION['editemail'] = $userinfo['mail'];
    $_SESSION['editemail2'] = $userinfo['mail'];
    //Verification des donnees envoyees
    if (isset($_POST['editer'])) {

      //protection des donnees avec la fonction htmlspecialchars et password_hash
      $nom = htmlspecialchars($_POST['nom']);
      $prenoms = htmlspecialchars($_POST['prenoms']);
      $email = htmlspecialchars($_POST['email']);
      $email2 = htmlspecialchars($_POST['email2']);
      $_SESSION['editnom'] = $nom;
      $_SESSION['editprenoms'] = $prenoms;
      $_SESSION['editemail'] = $email;
      $_SESSION['editemail2'] = $email2;
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
            if ($emailexist == 0 OR $email = $userinfo['mail']) {
              //On compare les deux mots de passe
              if ($_POST['mdp'] === $_POST['mdp2']) {
                $mdp = sha1($_POST['mdp']);
                $insertmbr = $bdd->prepare("UPDATE membres SET nom = $nom, prenoms = $prenoms, mail = $email, mdpass = $mdp WHERE id = $getid");
                header("location: profile.php?id=".$getid);
              }
              else {
                $erreur = 'Les deux mot de passe sont differents';
                $_SESSION['editerreur'] = $erreur;
              }
            }
            else {
              $erreur = 'L\'adresse mail existe deja';
              $_SESSION['editerreur'] = $erreur;
            }
          }
          else {
            $erreur = 'L\'adresse mail n\'est pas valide';
            $_SESSION['editerreur'] = $erreur;
          }
        }
        else {
          $erreur = "Les adresses mail doivent etre identique !";
          $_SESSION['editerreur'] = $erreur;
        }
      }
      else {
        $erreur = "Veuillez renseigner toutes les informations !";
        $_SESSION['editerreur'] = $erreur;
      }
    }
  }
  $title = '';
	require 'header.php';
	?>
	<body >
		<div class="container-fluid page-body ">
			<div class="card-container">
				<div class="row card-container-small">
					<div class="card-left col-lg-6 col-md-6 col-sm-12 ">
						<form id="formulaire" method="POST">
							<div class="container-form inscription-form">
								<h1>Editer</h1>
								<p><a href="profile.php?id=<?= $getid ?>">annuler</a><br>
								<?php
									if (isset($_SESSION['editerreur'])) {
										echo '<font color="#e32b17">' . $_SESSION['editerreur'] . '</font>'; 
									}
								?>
								</p>
								<input class="champdesaisir" type="text" name="nom" placeholder="Nom" value="<?php if(isset($_SESSION['editnom'])) { echo $_SESSION['editnom']; } ?>"> 
								<br>
								<input class="champdesaisir" type="text" name="prenoms" placeholder="Prenoms" value="<?php if(isset($_SESSION['editprenoms'])) { echo $_SESSION['editprenoms']; } ?>"> 
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
	<?php require 'footer.php'; ?>
</html>
