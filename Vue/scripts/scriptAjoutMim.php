<?php


try {
	$bdd = new PDO('mysql:host=localhost;dbname=bdd-dirisi;charset=utf8', 'root', 'Dir1si_');
}

 catch (\Exception $e) {
  die('erreur :' . $e->getMessage());
}

$valid=false;

if(!empty($_POST)) {
	extract($_POST);
	$valid = true;

    $Type = $_POST['Type'];
    $Debit = $_POST['debit'];
	$organisme = $_POST['prodId'];
    
    switch ($_POST['etat']) {
	case 'Active':
		$Etat = 1;
		break;
	case 'Inactive':
		$Etat = 0;
		break;
	}
}

if($valid){
$requete = $bdd->prepare('INSERT INTO `mim3`(`Type`, `Debit`, `Id_organisme`) VALUES ("'.$Type.'","'.$Debit.'","'.$organisme.'");');

	$requete->execute();
	header('Location: http://'.$_SERVER['HTTP_HOST'].$fquery);


	exit;
}
?>
