<?php
  include_once('../connexionbdd.php');
 global $bdd;
$data = array();
$errors = array();


$valid = false;

$debitErr=""; $dfuturErr=""; $idErr=""; $triErr=""; $etatErr=""; $trvErr=""; $orgaErr ="";

if(!empty($_POST)) {
	extract($_POST);
    $valid = true;

    //Vérification ID
        if(!isset($fId)){
            $idErr .= "<p>La ligne sélectionnée ne peut pas être modifié.</p>Essayez d'actualiser la page et de réessayer.</p>";
            $valid = false;
        } else {
            $fId = htmlspecialchars(stripslashes(trim($fId))); 
        }


    //Vérification ID travaux, modification 
    if(isset($fIdtrv)){
        if(!is_numeric($fIdtrv)){
            $trvErr .= "<p>Le travail sélectionné ne peut pas être modifié.</p>Essayez d'actualiser la page et de réessayer.</p>";
            $valid = false;
        } else {
            $fIdtrv = htmlspecialchars(stripslashes(trim($fIdtrv))); 
        }
   
    }

   

    //Vérification débit
    if(!isset($fDebit)){
        $debitErr .= "<p>Veuillez renseigner une valeur de débit.</p>";
        $valid = false; 
    } else if(!is_numeric($fDebit)){
        $debitErr .= "<p>Le débit que vous avez rentré n'est pas valable.</p>";
        $valid = false; 
    } else {
        $fDebit = str_replace(',', '.', htmlspecialchars(stripslashes(trim($fDebit))));
    }

    //Vérification débit futur
    if(!isset($fDebit_futur)){
        $dfuturErr .= "<p>Veuillez renseigner une valeur de débit futur.</p>";
        $valid = false; 
    } else if(!is_numeric($fDebit_futur)){
        $dfuturErr .= "<p>Le débit futur que vous avez rentré n'est pas valable.</p>";
        $valid = false; 
    } else {
        $fDebit_futur = str_replace(',', '.', htmlspecialchars(stripslashes(trim($fDebit_futur))));
    }

    //Vérifier état
    if(isset($fEtat)){
        switch ($fEtat) {
            case 'Prévu':
              $Etat = 1;
              break;
            case 'Fini':
              $Etat = 0;
              break;
            default:
              $etatErr .="<p>L'état renseigné n'est pas une option.</p>";
              $valid=false;
              break;
            } 
    } else { 
        $etatErr .="<p>Veuillez renseigner l'état de cette ligne.</p>";
        $valid=false;
    }

}

if($valid){
    if($script){
        if($identification){
            $requete = $bdd->prepare('UPDATE `travaux_opera` SET `Date`="'.$fDate.'",`Debit`="'.$fDebit.'",`Debit_futur`="'.$fDebit_futur.'",`Etat`="'.$Etat.'" WHERE `Id_trv_opera`="'.$fIdtrv.'" AND `Id_opera`="'.$fId.'";');
            $requete->execute();
        } else {
            $requete = $bdd->prepare('UPDATE `travaux_mim3` SET `Date`="'.$fDate.'",`Etat`="'.$Etat.'",`Debit_futur`="'.$fDebit_futur.'",`Debit`="'.$fDebit.'" WHERE `Id8_trv_mim`="'.$fIdtrv.'" AND `Id_mim`="'.$fId.'";');
            $requete->execute();
        }
    } else {
        if($identification){
            $requete = $bdd->prepare('INSERT INTO `travaux_opera`(`Date`, `Etat`, `Debit_futur`, `Debit`,`Id_opera`)  VALUES ("'.$fDate.'","'.$Etat.'","'.$fDebit_futur.'","'.$fDebit.'","'.$fId.'");');
            $requete->execute();
        } else {
            $requete = $bdd->prepare('INSERT INTO `travaux_mim3`(`Date`, `Etat`, `Debit_futur`, `Debit`, `Id_mim`) VALUES ("'.$fDate.'","'.$Etat.'","'.$fDebit_futur.'","'.$fDebit.'","'.$fId.'");');
            $requete->execute();
        }
    }
    $data['success'] = true;
    $data['script'] = $script;
    $data['type'] = $identification;
    
} else {
  $errors = array($debitErr, $dfuturErr, $idErr, $triErr, $etatErr, $trvErr, $orgaErr);
  $data['success'] = false;
  $data['errors']  = $errors;
}


    $data["loadpage"] = 'https://'.$_SERVER['HTTP_HOST'].'/BCS';


echo json_encode($data);

?>
