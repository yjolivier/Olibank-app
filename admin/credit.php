<?php
session_start();
require "../projet/model.php";
require 'header.php';
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
        <h1>Crediter le compte de : <?php echo $userinfo['nom']." ".$userinfo['prenoms']." avec pour email : ".$userinfo['mail'] ?></h1>
        <h2> Noter dans le champ la somme a Crébiter </h2>
        <form id="debit-form" method="POST">
          <input class="champdesaisir debit-champ" type="number" name="montcredit" placeholder="montant a debiter"> <br>
          <input class="form-bouton debit-button" name="crediter" type="submit" value="Envoyer" />
        </form>
      </div>
    </div>
  </body>
<?php
}
if (isset($_POST['crediter']) AND !empty($_POST['montcredit'])) {
  $montant = (int) $_POST['montcredit'];
  $req = $bdd->prepare("INSERT INTO compte_credit_client(id_membre, montant, date_credit) VALUES(?, ?, NOW())");
  $req->execute(array($getid, $montant));
  header("location: profile-admin.php?id=".$_SESSION['adminid']);
}
?>