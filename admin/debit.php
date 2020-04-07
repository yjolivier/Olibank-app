<?php
session_start();
require "../projet/model.php";
require 'header.php';
  $oui = "oui";
	$title = '';
	//connexin a la base de donnée
	$bdd = dbConnect();
if (isset($_GET['id']) AND $_GET['id'] > 0) {

	//Convertir l'id en nombre
	$getid = intval($_GET['id']);
	$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
	$requser->execute(array($getid));
  $userinfo = $requser->fetch();
}
else {
  header("location: ../404.php");
}

if ($userinfo){ ?>
  <body>
    <div class="container delete-container d-flex justify-content-center">
      <div class="debit-content col-8">
        <h1>Debiter le compte de : <?php echo $userinfo['nom']." ".$userinfo['prenoms']." avec pour email : ".$userinfo['mail'] ?></h1>
        <h2> Noter dans le champ la somme a debiter </h2>
        <form id="debit-form" method="POST">
          <input class="champdesaisir debit-champ" type="number" name="montdebit" placeholder="montant a debiter"> <br>
          <input class="form-bouton debit-button" name="debiter" type="submit" value="Envoyer" />
        </form>
      </div>
    </div>
  </body>
<?php
}
if (isset($_POST['debiter']) AND !empty($_POST['montdebit'])) {
  $montant = (int) $_POST['montdebit'];
  $req = $bdd->prepare("INSERT INTO compte_debit_client(id_membre, montant, date_debit) VALUES(?, ?, NOW())");
  $req->execute(array($getid, $montant));
  header("location: profile-admin.php?id=".$_SESSION['adminid']);
}
?>