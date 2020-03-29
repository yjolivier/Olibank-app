<?php 

function dbConnect(){
  //Connexion a la base de donnee
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=olibank;charset=utf8', 'root', '');
  }
  catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }
  return $bdd;
}