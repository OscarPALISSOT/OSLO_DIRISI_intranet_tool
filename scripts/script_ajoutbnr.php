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


switch ($_POST['fEtat']) {
	case 'prévus':
		$requete = $bdd->prepare('INSERT INTO `bnrs` (`ID`, `Nature`, `Zone`,  `N_ASAP`, `N_SERVICE_du_PDC`, `N_RANG`, `Priorisation`, `Bénéficiaire`, `BDD_Impliquée`, `Description_Service`, `Objectifs_et_description_fonctionnelle`, `Montant_FEB`,  `Date_retour_DTS`, `Point_de_situation`, `(J/H)_Chef_de_projet`, `(J/H)_Technicien`,) VALUES ("'.$fId.'","'.$fNature.'","'.$fZone.'","'.$fAsap.'","'.$fService.'","'.$fRang.'","'.$fPriorisation.'","'.$fBénéficiaire.'","'.$fBDDImpliquée.'","'.$fDescription.'","'.$fObjectifs.'","'.$fFEB.'","'.$fDTS.'","'.$fSituation.'","'.$fChef.'","'.$fTechnicien.'");');
      $requete->execute();
		break;
	case 'finis':
		$requete = $bdd->prepare('INSERT INTO `bnrs` (`ID`, `Nature`, `Zone`,  `N_ASAP`, `N_SERVICE_du_PDC`, `N_RANG`, `Priorisation`, `Bénéficiaire`, `BDD_Impliquée`, `Description_Service`, `Objectifs_et_description_fonctionnelle`, `Montant_FEB`,  `Date_retour_DTS`, `Point_de_situation`, `(J/H)_Chef_de_projet`, `(J/H)_Technicien`,) VALUES ("'.$fId.'","'.$fNature.'","'.$fZone.'","'.$fAsap.'","'.$fService.'","'.$fRang.'","'.$fPriorisation.'","'.$fBénéficiaire.'","'.$fBDDImpliquée.'","'.$fDescription.'","'.$fObjectifs.'","'.$fFEB.'","'.$fDTS.'","'.$fSituation.'","'.$fChef.'","'.$fTechnicien.'");');
      $requete->execute();
	
		break;
	}



	
	header('Location: https://'.$_SERVER['HTTP_HOST'].'/BRC');
	

	exit;
}
?>

