<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bdd-dirisi;charset=utf8', 'root', 'Dir1si_');
   
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

    /*if(!(is_numeric($fAnnee) && (strlen($fAnnee) == 4)) || !is_numeric($fCout)  || !(strlen($fTrigramme) == 3)){
      $valid = false;
  }*/
   
}

if($valid){
     $requete = $bdd->prepare('UPDATE `modip` SET `N_ASAP`="'.$fAsap.'",`Numero_DECLIC`="'.$fnumerodeclic.'",`Trigramme`="'.$fTrigramme.'",`Numero_rang`="'.$fnumeroRang.'",`Description_service`="'.$fdescriptionservice.'",`Montant_FEB`="'.$fmontant.'", `Date_retour_DTS`="'.$fDate.'",`Point_de_situation`="'.$fsituation.'",`Annee`="'.$fAnnee.'" WHERE `Id_modip`="'.$fId_modip.'" AND `Trigramme`="'.$fTrigramme.'";');
      $requete->execute();
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/BPT');
	 exit;
} else {
  header('Location: http://'.$_SERVER['HTTP_HOST'].'/BRC');
}
?>
