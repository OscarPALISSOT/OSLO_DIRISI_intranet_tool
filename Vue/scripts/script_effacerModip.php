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
    
    if(!is_numeric($fIdModip) || !(strlen($fTrigramme) == 3)){
        $valid=false;
    }

}

if($valid){
    $requete = $bdd->prepare('DELETE FROM `modip` WHERE `Id_modip`='.$fIdModip.';');
      $requete->execute();
      header('Location: https://'.$_SERVER['HTTP_HOST'].'/quartiers?trigramme='.$fTrigramme);
      
	 exit;
} else {
  //ERREUR: Le travail MIM3 n'a pas pu être modifié
}
?>
