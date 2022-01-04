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
  switch ($fEtat) {
	case 'Actif':
		$Etat = 1;
		break;
	case 'Inactif':
		$Etat = 0;
		break;
	}
}

if($valid){
	$requete = $bdd->prepare('UPDATE `mim3` SET `Type`= "'.$fType.'", `Debit`="'.$fDebit.'", `Debit_final`="'.$fDebitfinale.'", `Trigramme`="'.$fTrigramme.'", `mim3`.`Organisme`="'.$fOrganisme.'", `Master_ID`="'.$fMasterID.'", `IP_LAN_SUBNET`="'.$fIpLanSubnet.'",`IP_PFS`="'.$fIpPfs.'", `Etat`="'.$fEtat.'", `Date_de_validation`="'.$fDateValidation.'"WHERE `Id_mim`="'.$fId_mim.'";');
	$requete->execute();
	 //echo "heloo";
	 header('Location: https://'.$_SERVER['HTTP_HOST'].'/BCS');
	exit;
} else {
  
  echo "Le changement n'a pas pu être effectué";
}
?>
