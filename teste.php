<?php
session_start();
require "model/model.php";
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
  header("location: 404.php");
}

if ($userinfo){ ?>
  <body>
    <div class="container delete-container d-flex justify-content-center">
      <div class="delete-content col-8">
        <h1>Vous voulez Supprimer ce Utilisateur ?</h1>
        <h2>
          <?php echo $userinfo['nom']." ".$userinfo['prenoms']." avec pour email : ".$userinfo['mail'] ?>
          <br>
          Si vous confirmez les données supprimées ne pourrons plus être récupérées 
        </h2>
        <div class="button-container">
          <div class="delete-button oui">
            <a href="teste.php?id=<?= $getid ?>&value=<?= $oui ?>">Oui</a>
          </div>
          <div class="delete-button non">
            <a href="http://localhost/olibank/admin/profile-admin.php?id=<?= $_SESSION['adminid']?>">non</a>
          </div>
        </div>
      </div>
    </div>
  </body>
<?php
}
if (isset($_GET['value']) AND !empty($_GET['value']) AND $_GET['value'] = $oui) {
    $req = $bdd->prepare("DELETE FROM membre WHERE id = ? ");
    $req->execute(array($getid));
    header("location: 404.php");
  }
?>