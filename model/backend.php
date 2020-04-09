<?php

//Select admin info where id 
function AdminInfo($AdminId){
  $bdd = dbConnect();
  $reqadmin = $bdd->prepare("SELECT * FROM administrateur WHERE id = ?");
  $reqadmin->execute(array($AdminId));
  return $reqadmin;
}

//Select admin info
function SelectAdmin($mailadmin, $mdpadmin){
  $bdd = dbConnect();
  $requser = $bdd->prepare("SELECT * FROM administrateur WHERE mail = ? AND motdepass = ?");
  $requser->execute(array($mailadmin, $mdpadmin));
  return $requser;
}


//Select one user debit 
function UserDebitInfo($UserId){
  $bdd = dbConnect();
  $reqdeb = $bdd->query("SELECT montant FROM compte_debit_client WHERE id_membre = $UserId ");
  while ($reponse = $reqdeb->fetch()) {
    $debit[] = array(
      "montant" => (int)$reponse['montant']
    );
  }
  if (!empty($debit)) {
    return $debit;
  }
}

//Select one user credit 
function UserCreditInfo($UserId){
  $bdd = dbConnect();
  $reqcred = $bdd->query("SELECT montant FROM compte_credit_client WHERE id_membre = $UserId");
  while ($reponse = $reqcred->fetch()) {
    $credit[] = array(
      "montant" => (int)$reponse['montant']
    );
  }
  if (!empty($credit)){
    return $credit;
  }
}

// searches for user information
function FetchUsuerInfo($UserId){
  $bdd = dbConnect();
  $requser = $bdd->query("SELECT * FROM membres WHERE id = $UserId");
  $userinfo = $requser->fetch();
  return $userinfo;
}

// Insert debit function
function InsertDebit($getid, $montant){
  $bdd = dbConnect();
  $req = $bdd->prepare("INSERT INTO compte_debit_client(id_membre, montant, date_debit) VALUES(?, ?, NOW())");
	$req->execute(array($getid, $montant));
}

//Insert Credit function
function InsertCredit($getid, $montant){
  $bdd = dbConnect();
  $req = $bdd->prepare("INSERT INTO compte_credit_client(id_membre, montant, date_credit) VALUES(?, ?, NOW())");
  $req->execute(array($getid, $montant));
}

//Membre delete 
function DeleteMembre($UserId){
  $bdd = dbConnect();
  $req = $bdd->prepare("DELETE FROM membres WHERE id = ? ");
  $req->execute(array($UserId));
}

//Connexion a la base de donnee
function dbConnect(){
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=olibank;charset=utf8', 'root', '');
    return $bdd;
  }
  catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }
}