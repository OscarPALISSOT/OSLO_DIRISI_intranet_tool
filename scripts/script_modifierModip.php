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

    if(!(is_numeric($fAnnee) && (strlen($fAnnee) == 4)) || !is_numeric($fCout)  || !(strlen($fTrigramme) == 3)){
      $valid = false;
  }
}

if($valid){
  $requete = $bdd->prepare('UPDATE `modip` SET `Numero_DECLIC`="'.$fnumerodeclic.'",`Classement_DL`="'.$fDL.'",`Priorite_DECLIC`="'.$fPrioriteDeclic.'", `Site`="'.$fSite.'", `Classification_Site`="'.$fClassificationSite.'", `clients`="'.$fClients.'", `Classification_Operation`="'.$fClassificationOperation.'", `Cout`="'.$fCout.'", `Description`="'.$fDescription.'", `Categorie`="'.$fCategorie.'", `Type`="'.$fType.'", `reno_avant`="'.$fRenoAvant.'", `reno_apres`="'.$fRenoApres.'", `Annee_Coeur_av_tvx`="'.$fCoeurAvant.'", `Annee_reno_coeur`="'.$fAnneeCoeur.'", `Annee`="'.$fAnnee.'", `Semestre`="'.$fSemestre.'" WHERE `ID`="'.$fID.'"');
  $requete->execute();
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/BPT');
	 exit;
} else {
  header('Location: https://'.$_SERVER['HTTP_HOST'].'/BRC');
}
?>
