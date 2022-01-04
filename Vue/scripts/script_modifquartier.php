<?php
$user="root";
$password = "Dir1si_";
$dbname = "bdd-dirisi";
$host = "localhost";
try
{
  global $bdd;
	$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
   
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$valid = false;

if(!empty($_POST)) {
	extract($_POST);
    $valid = true;


    if(!(strlen($fTrigramme) == 3)){
      $valid = false;
  }
}

if($valid){
     $requete = $bdd->prepare('UPDATE `quartiers` SET `Adresse`="'.$fAdresse.'",`Nom`="'.$fNom.'" WHERE `Trigramme`= "'.$fTrigramme.'" ;');
      $requete->execute();
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/quartiers?trigramme='.$fTrigramme);
	 exit;
} else {
  //ERREUR: La ligne OPERA n'a pas pu être modifié
}
?>
