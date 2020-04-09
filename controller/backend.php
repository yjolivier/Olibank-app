<?php
session_start();
require('model/backend.php');

function profileAdmin(){
	$solde = 0;
	$DebMont = 0;
	$CredMont = 0;
	
	if (isset($_GET['id']) AND $_GET['id'] = $_SESSION['adminid']) {
		
		//Convertir l'id en nombre 
		$getid = intval($_GET['id']);
		$reqadmin = AdminInfo($getid);
		$admininfo = $reqadmin->fetch();
		
		require 'header.php';
		require 'view/backend/AdminProfileView.php';
		require 'footer.php';
	}
}

function debit(){
	require 'header.php';
	$title = '';
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
		require 'view/backend/CreditView.php';
	}
	if (isset($_POST['crediter']) AND !empty($_POST['montcredit'])) {
		$montant = (int) $_POST['montcredit'];
		InsertCredit($getid, $montant);
		header("location: admin.php?id=".$_SESSION['adminid']);
	}
}

function supprimer(){
	$title = '';
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