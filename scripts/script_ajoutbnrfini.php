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


$valid=false;

if(!empty($_POST)) {
	extract($_POST);
	$valid = true;

}

if($valid){


$requete = $bdd->prepare('INSERT INTO `bnrs` (`ID`, `Nature`, `Zone`,  `N° ASAP`, `N° SERVICE du PDC`, `N° RANG`, `Priorisation`, `Bénéficiaire`, `BDD Impliquée`, `Description Service`, `Objectifs et description fonctionnelle`, `Montant FEB`,  `Date retour DTS`, `Point de situation`, `(J/H) Chef de projet`, `(J/H) Technicien`,) VALUES ("'.$fId.'","'.$fNature.'","'.$fZone.'","'.$fAsap.'","'.$fService.'","'.$fRang.'","'.$fPriorisation.'","'.$fBénéficiaire.'","'.$fBDDImpliquée.'","'.$fDescription.'","'.$fObjectifs.'","'.$fFEB.'","'.$fDTS.'","'.$fSituation.'","'.$fChef.'","'.$fTechnicien.'");');
      $requete->execute();
	
      header('Location: https://'.$_SERVER['HTTP_HOST'].$fquery);


	exit;
}
?>
