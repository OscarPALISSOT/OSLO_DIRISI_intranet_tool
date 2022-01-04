<?php
$user="root";
$password = "Dir1si_";
$dbname = "bdd-dirisitest";
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


   
  }
if($valid){
     $requete = $bdd->prepare('UPDATE `bnrs_finis` SET `bnrs_finis`.`Commentaire`="'.$fCommentaire.'" WHERE `ID`="'.$fID.'"');
      $requete->execute();
    header('Location: https://'.$_SERVER['HTTP_HOST'].'');
	 exit;
} else {
  //ERREUR: La ligne OPERA n'a pas pu être modifié
}
?>
