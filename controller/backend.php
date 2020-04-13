<?php
session_start();
require('model/backend.php');

function profileAdmin(){
	$solde = 0;
	$DebMont = 0;
	$CredMont = 0;
	$confirmer = 0;
	$title = 'Espace Admin';
	if (isset($_GET['id']) AND $_GET['id'] == $_SESSION['adminid']) {
		
		//Convertir l'id en nombre 
		$getid = intval($_GET['id']);
		$reqadmin = AdminInfo($getid);
		$admininfo = $reqadmin;
		require 'header.php';
		require 'view/backend/AdminProfileView.php';
		require 'footer.php';
	}
}

function debit(){
	require 'header.php';
	$title = 'Debit Compte';
	if (isset($_GET['id']) AND $_GET['id'] > 0) {

		//Convertir l'id en nombre
		$getid = intval($_GET['id']);
		$userinfo = FetchUsuerInfo($getid);
	}
	else {
		header("location: ../404.php");
	}

	if ($userinfo){
		require 'view/backend/DebitView.php'; 
	}
	if (isset($_POST['debiter']) AND !empty($_POST['montdebit'])) {
		$montant = (int) $_POST['montdebit'];
		InsertDebit($getid, $montant);
		header("location: admin.php?id=".$_SESSION['adminid']);
	}
}

function credit(){
	$title = 'Credit Compte';
	require 'header.php';
	if (isset($_GET['id']) AND $_GET['id'] > 0) {

		//Convertir l'id en nombre
		$getid = intval($_GET['id']);
		$userinfo = FetchUsuerInfo($getid);
	}
	else {
		header("location: ../404.php");
	}

	if ($userinfo){ 
		require 'view/backend/CreditView.php';
	}
	if (isset($_POST['crediter']) AND !empty($_POST['montcredit'])) {
		$montant = (int) $_POST['montcredit'];
		InsertCredit($getid, $montant);
		header("location: admin.php?id=".$_SESSION['adminid']);
	}
}

function supprimer(){
	$title = 'Suppression compte';
	require 'header.php';
  $oui = "oui";
	if (isset($_GET['id']) AND $_GET['id'] > 0) {

		//Convertir l'id en nombre
		$getid = intval($_GET['id']);
		$userinfo = FetchUsuerInfo($getid);
	}
	else {
		header("location: ../404.php");
	}

	if ($userinfo){
		require 'view/backend/AdminDeleteView.php';
	}
	if (isset($_GET['value']) AND !empty($_GET['value']) AND $_GET['value'] == $oui) {
		DeleteMembre($getid);
		header("location: admin.php?id=".$_SESSION['adminid']);
  }
}

function deconnexion(){
	$_SESSION = array();
	session_destroy();
	header("location: index.php");
}

function compte(){
	$title = "Info compte";
	if (isset($_GET['id']) AND $_GET['id'] == $_SESSION['adminid']) {
		
		//Convertir l'id en nombre 
		$getid = intval($_GET['id']);
		$reqadmin = AdminInfo($getid);
		$admininfo = $reqadmin;
		
		require 'header.php';
		require 'view/backend/AdminCompteView.php';
		require 'footer.php';
	}

}

function EditAdmin(){
	$title = "Edit admin";
	if(isset($_GET['id']) AND $_GET['id'] > 0){
		//Convertir l'id en nombre
	  $getid = intval($_GET['id']);
	  $admininfo = AdminInfo($getid);
    $_SESSION['editnom'] = $admininfo['nom'];
    $_SESSION['editcontacte'] = $admininfo['contacte'];
    $_SESSION['editemail'] = $admininfo['mail'];
		$_SESSION['editemail2'] = $admininfo['mail'];

		if (isset($_POST['editer'])) {

      //protection des donnees avec la fonction htmlspecialchars et password_hash
      $nom = htmlspecialchars($_POST['nom']);
      $contacte = htmlspecialchars($_POST['contacte']);
      $email = htmlspecialchars($_POST['email']);
      $email2 = htmlspecialchars($_POST['email2']);
      $_SESSION['editnom'] = $nom;
      $_SESSION['editcontacte'] = $contacte;
      $_SESSION['editemail'] = $email;
      $_SESSION['editemail2'] = $email2;
      /*$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);*/
      if (
        !empty($_POST['nom']) AND 
        !empty($_POST['contacte']) AND 
        !empty($_POST['email']) AND 
        !empty($_POST['email2']) AND 
        !empty($_POST['mdp']) AND 
        !empty($_POST['mdp2'])) 
      {
        if ($email === $email2) {
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						//Verifions si le mail existe deja ou pas.
						$bdd = dbConnect();
  					$requser = $bdd->prepare("SELECT * FROM administrateur WHERE mail = ?");
  					$requser->execute(array($email));
            $emailexist = $requser->rowCount();
            if ($emailexist == 0 OR $getid == $admininfo['id']) {
              //On compare les deux mots de passe
              if ($_POST['mdp'] === $_POST['mdp2']) {
								$mdp = sha1($_POST['mdp']);
								UpdateAdmin($nom, $contacte, $email, $mdp, $getid);
								$_SESSION['id'] = $getid;
                header("location: admin.php?id=".$getid);
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
	require 'header.php';
	require 'view/backend/AdminEditView.php';
	require 'footer.php';
}