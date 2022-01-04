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

    $fCout = str_replace(',', '.', $fCout);

    $fDescription = htmlspecialchars($fDescription);

    
 }

if($valid){
  $requete = $bdd->prepare('INSERT INTO `modip`(`Numero_DECLIC`, `Classement_DL`, `Priorite_DECLIC`, `Site`, `Trigramme`, `Classification_Site`, `clients`, `Classification_Operation`, `Cout`, `Description`, `Categorie`, `Type`, `reno_avant`, `reno_apres`, `Annee_Coeur_av_tvx`, `Annee_reno_coeur`, `Annee`, `Semestre`, `Etat` ) VALUES ("'.$fnumerodeclic.'", "'.$fClassementDL.'", "'.$fPrioriteDECLIC.'", "'.$fSite.'", "'.$fTrigramme.'", "'.$fClassificationSite.'", "'.$fClients.'", "'.$fClassificationOperation.'", "'.$fCout.'", "'.$fDescription.'", "'.$fCategorie.'", "'.$fType.'","'.$fRenoAvant.'","'.$fRenoApres.'","'.$fAnneeCoeurAvant.'","'.$fAnneeCoeurApres.'", "'.$fAnnee.'", "'.$fSemestre.'",1);');
  $requete->execute();
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/BPT');
	 exit;
} else {
  //ERREUR: La ligne OPERA n'a pas pu être modifié
}
?>
