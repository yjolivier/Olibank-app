<?php
session_start();
	require "model/model.php";
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
?>
