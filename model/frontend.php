<?php 

//Select users who have for mail $mailconnect
function SelectUser($mailconnect){
  $bdd = dbConnect();
  $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
  $requser->execute(array($mailconnect));
  return $requser;
}

// searches for user information
function FetchUsuerInfo($UserId){
  $bdd = dbConnect();
  $requser = $bdd->query("SELECT * FROM membres WHERE id = $UserId");
  $userinfo = $requser->fetch();
  return $userinfo;
}

//Select all user debit info
function FetchDebit($UserId){
  $bdd = dbConnect();
  $reqdeb = $bdd->query("SELECT montant, DATE_FORMAT(date_debit, '%d/%m/%Y %Hh%imin%ss') AS date_debit FROM compte_debit_client WHERE id_membre = $UserId ORDER BY date_debit DESC");
  while ($reponse = $reqdeb->fetch()) {
		$debit[] = array(
      "montant" => (int)$reponse['montant'],
			"date" => $reponse['date_debit']
		);
  }
  if (!empty($debit)) {
    return $debit;
  }
}

//Select all user credit info
function FetchCredit($UserId){
  $bdd = dbConnect();
  $reqcred = $bdd->query("SELECT montant, DATE_FORMAT(date_credit, '%d/%m/%Y %Hh%imin%ss') AS date_credit FROM compte_credit_client WHERE id_membre = $UserId ORDER BY date_credit DESC");
	
	while ($repcred = $reqcred->fetch()) {
    $credit[] = array(
			"montant" => (int)$repcred['montant'],
			"date" => $repcred['date_credit']
		);
  }
  if (!empty($credit)) {
    return $credit;
  }
}

// Membre insert into data base 
function MbrInsert($nom, $prenoms, $email, $mdp){
  $bdd = dbConnect();
  $insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenoms, mail, mdpass, date_inscription) VALUES(?, ?, ?, ?, NOW())");
  $insertmbr->execute(array($nom, $prenoms, $email, $mdp));
  $LastId = $bdd->lastInsertId();
  return $LastId;
}

// Membre insert into data base 
function update($nom,$prenom,$email,$mdp){
  $bdd = dbConnect();
  $UpdatMbr = $bdd->prepare("UPDATE membres SET nom = $nom, prenoms = $prenoms, mail = $email, mdpass = $mdp WHERE id = $getid");
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
