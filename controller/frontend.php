<?php
session_start();
require('model/frontend.php');

function connexion(){
  if (isset($_POST['connexion'])) {
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);

		if (!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect'])) {
			if (filter_var($mailconnect, FILTER_VALIDATE_EMAIL)) {
				$requser = SelectUser($mailconnect);
				$userexist = $requser->rowCount();
				if ($userexist == 1) {
					$userinfo = $requser->fetch();
					$_SESSION['id'] = $userinfo['id'];
					$_SESSION['email'] = $userinfo['email'];
					$_SESSION['nom'] = $userinfo['nom'];
					$_SESSION['prenoms'] = $userinfo['prenoms'];
					header("location: page.php?id=".$_SESSION['id']);
				}
				else {
					$erreur = 'Adresse mail ou mot de passe incorrect';
					$_SESSION['erreur'] = $erreur;
					header("location: index.php");
				}
			}
			else {
				$erreur = 'L\'adresse mail est invalide';
				header("location: index.php");
				$_SESSION['erreur'] = $erreur;
			}
		}
		else{
			$erreur = 'Tout les champs doivent être remplient';
			$_SESSION['erreur'] = $erreur;
			header("location: index.php");
		}
	}
  require 'header.php';
	require 'view/ConnexionView.php';
	require 'footer.php'; 
}

function inscription(){
  //Verification des donnees envoyees
	if (isset($_POST['inscription'])) {

		//protection des donnees avec la fonction htmlspecialchars et password_hash
		$nom = htmlspecialchars($_POST['nom']);
		$prenoms = htmlspecialchars($_POST['prenoms']);
		$email = htmlspecialchars($_POST['email']);
		$email2 = htmlspecialchars($_POST['email2']);
		$_SESSION['inscrinom'] = $nom;
		$_SESSION['inscriprenoms'] = $prenoms;
		$_SESSION['inscriemail'] = $email;
		$_SESSION['inscriemail2'] = $email2;
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
					$reqmail = SelectUser($email);
					$emailexist = $reqmail->rowCount();
					if ($emailexist == 0) {
						//On compare les deux mots de passe
						if ($_POST['mdp'] === $_POST['mdp2']) {
							$mdp = sha1($_POST['mdp']);
							//insert membre at data base
							$_SESSION['id'] = MbrInsert($nom, $prenoms, $email, $mdp);
							header("location: page.php?id=".$_SESSION['id']);
						}
						else {
							$erreur = 'Les deux mot de passe sont differents';
							$_SESSION['inscrierreur'] = $erreur;
						}
					}
					else {
						$erreur = 'L\'adresse mail existe deja';
						$_SESSION['inscrierreur'] = $erreur;
					}
				}
				else {
					$erreur = 'L\'adresse mail n\'est pas valide';
					$_SESSION['inscrierreur'] = $erreur;
				}
			}
			else {
				$erreur = "Les adresses mail doivent etre identique !";
				$_SESSION['inscrierreur'] = $erreur;
			}
		}
		else {
			$erreur = "Veuillez renseigner toutes les informations !";
			$_SESSION['inscrierreur'] = $erreur;
		}
	}
	require 'header.php';
	require 'view/inscription-view.php';
	require 'footer.php'; 
}

function profile(){
  $title = '';
	$solde = 0;

  if (isset($_GET['id']) AND $_GET['id'] > 0) {

    //Convertir l'id en nombre
    $getid = intval($_GET['id']);
    $userinfo = FetchUsuerInfo($getid);

    //recuperer tout les debits
    $debit = FetchDebit($getid);
    if (!empty($debit)) {
      foreach ($debit as $k => $value) {
        $DebitMont[] = $value['montant']; 
      }
      $DebMont = array_sum($DebitMont);
    }

    //recuperer tout les credits
    $credit = FetchCredit($getid);
    if (!empty($credit)) {
      foreach ($credit as $k => $value) {
        $CreditMont[] = $value['montant']; 
      }
      $CredMont = (int)array_sum($CreditMont);
    }
  }
  require 'view/profile-view.php';
}

function compte(){
  $title = '';
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
    require 'view/CompteView.php';
  }
}


function contacte(){
  #...
}

function deconnexion(){
  $_SESSION = array();
  session_destroy();
  header("location: index.php");
}

function edituser(){
	if(isset($_GET['id']) AND $_GET['id'] > 0){
    //Convertir l'id en nombre
	  $getid = intval($_GET['id']);
	  $userinfo = FetchUsuerInfo($getid);
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
            $reqmail = SelectUser($email);
            $emailexist = $reqmail->rowCount();
            if ($emailexist == 0 OR $email = $userinfo['mail']) {
              //On compare les deux mots de passe
              if ($_POST['mdp'] === $_POST['mdp2']) {
                $mdp = sha1($_POST['mdp']);
                update($nom,$prenom,$email,$mdp);
                header("location: page.php?id=".$getid);
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
	require 'view/EditView.php';
	require 'footer.php';
}