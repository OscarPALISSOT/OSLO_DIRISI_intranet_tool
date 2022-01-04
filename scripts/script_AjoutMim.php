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


    
    switch ($etat) {
	case 'Active':
		$Etat = 1;
		break;
	case 'Inactive':
		$Etat = 0;
		break;
	}
}

if($valid){
$requete = $bdd->prepare('INSERT INTO `mim3`(`Master_ID`, `IP_LAN_SUBNET`, `IP_PFS`, `Type`, `Debit`, `Id_organisme`, `Trigramme`, `Etat`) VALUES ("'.$MasterID.'","'.$IpLanSubnet.'","'.$IpPfs.'","'.$Type.'","'.$Debit.'","'.$Organisme.'","'.$Trigramme.'","'.$Etat.'");');

	$requete->execute();
	header('Location: https://'.$_SERVER['HTTP_HOST'].'/BCS');


	exit;
} else { 
header('Location: https://'.$_SERVER['HTTP_HOST']);
}
?>
