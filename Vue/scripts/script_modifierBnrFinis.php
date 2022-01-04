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



    $fmontant = str_replace(',', '.', $fmontant);

   
  
}

if($valid){
  $requete = $bdd->prepare('UPDATE `bnrs_finis` SET `Nature`= "'.$fNature.'",`Zone`="'.$fZone.'" ,`N_ASAP`="'.$fAsap.'",`N_SERVICE_du_PDC`="'.$fService.'",`N_RANG`="'.$fRang.'",`Priorisation`="'.$fPriorisation.'",`Bénéficiaire`="'.$fBénéficiaire.'",`BDD_Impliquée`="'.$fBDDImpliquée.'", `Description_Service`="'.$fDescription.'", `Objectifs_et_description_fonctionnelle`="'.$fObjectifs.'", `Montant_FEB`="'.$fFEB.'", `Date_de_la_demande`="'.$fDemande.'", `Echeance_souhaitée`="'.$fEcheance.'", `Date_retour_DTS`="'.$fDTS.'", `Point_de_situation`="'.$fSituation.'", `(J/H)_Chef_de_projet`="'.$fChef.'", `(J/H)_Technicien`="'.$fTechnicien.'", `Trigramme`="'.$fTrigramme.'", `Organisme`="'.$fOrganisme.'" WHERE `ID`= "'.$fId.'"');
  $requete->execute();
     
      header('Location: https://'.$_SERVER['HTTP_HOST'].'/BRC');
 
     
	exit;
} else {
  //ERREUR: La ligne OPERA n'a pas pu être modifié
}
?>



