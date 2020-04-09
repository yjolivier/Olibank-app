<?php
session_start();
require "model/model.php";
$title = '';
require 'header.php';

	//connexin a la base de donnée
	$bdd = dbConnect();
if (isset($_GET['id']) AND $_GET['id'] > 0) {

	//Convertir l'id en nombre
	$getid = intval($_GET['id']);
	$requser = $bdd->query("SELECT id, nom, prenoms, mail, DATE_FORMAT(date_inscription, '%d/%m/%Y') AS date_inscription FROM membres WHERE id = $getid");
  $userinfo = $requser->fetch();
}
else {
  header("location: ../404.php");
}

if ($userinfo){ ?>
  <body>
    <div class="container delete-container d-flex justify-content-center">
      <div class="delete-content col-8 " style="text-align: left;">
        <h1><?php echo $userinfo['nom'].' '.$userinfo['prenoms'] ?></h1>
        <h2>
          E-mail : <?= $userinfo['mail'] ?> <br><br>
          Date inscription : <?= $userinfo['date_inscription'] ?> <br><br>
          Solde : <?= $_SESSION['mbrsolde'].' F'?>
        </h2>
        <div class="button-container" style="text-align: center;">
          <div class="delete-button oui">
            <a href="profile.php?id=<?= $_SESSION['id']?>">retour</a>
          </div>
          <div class="delete-button non">
            <a href="edit.php?id=<?= $_SESSION['id']?>">edit</a>
          </div>
        </div>
      </div>
    </div>
  </body>
<?php } ?>