<?php
  include_once('../connexionbdd.php');
 global $bdd;
$data = array();
$errors = array();


$valid = false;
$script = 0;  //0 ajouter 1 modifier
$debitErr=""; $idErr=""; $triErr=""; $etatErr=""; $typeErr="";

if(!empty($_POST)) {
	extract($_POST);
    $valid = true;

    if(!isset($fAccess)){
        $fAccess = "";
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


    //Vérification ID Opera
    if(isset($fId_opera)){
        if(!is_numeric($fId_opera)){
            $idErr .= "<p>La ligne OPERA sélectionné ne peut pas être modifié.</p>Essayez d'actualiser la page et de réessayer.</p>";
            $valid = false;
        } else {
            $fId_opera = htmlspecialchars(stripslashes(trim($fId_opera))); 
        }
        $script = 1;
    }
    

    //Vérification Trigramme
    if(!isset($fTrigramme) || !(strlen($fTrigramme) == 3)){
        $triErr .= "<p>La quartier sélectionné est erroné. Vérifier le trigramme fourni.</p>Essayez d'actualiser la page et de réessayer.</p>";
        $valid = false;
    } else {
        $fTrigramme = htmlspecialchars(stripslashes(trim($fTrigramme)));
    }

    //Vérifier état
    if(!!isset($fEtat)){
        switch ($fEtat) {
            case 'Actif':
              $Etat = 1;
              break;
            case 'Inactif':
              $Etat = 0;
              break;
            default:
              $etatErr .="<p>L'état renseigné n'est pas une option.</p>";
              $valid=false;
              break;
            } 
    } else { 
        $etatErr .="<p>Veuillez renseigner l'état de cette ligne OPERA.</p>";
        $valid=false;
    }

    //Vérifier type
    if(!!isset($fType)){
        switch ($fType) {
            case 'Fibre':
              break;
            case 'Cuivre':
              break;
            default:
              $typeErr .="<p>Le type renseigné n'est pas une option.</p>";
              $valid=false;
              break;
            } 
    } else {
        $typeErr .="<p>Veuillez renseigner le type de cette ligne OPERA.</p>";
              $valid=false;
    }

}



if($valid){
    if($script){
        $requete = $bdd->prepare('UPDATE `opera` SET Id_access="'.$fAccess.'", `Type`= "'.$fType.'", `Debit`="'.$fDebit.'",`Etat`="'.$Etat.'" WHERE `Id_opera`="'.$fId_opera.'" AND `Trigramme`="'.$fTrigramme.'";');
        $requete->execute();
    } else {
        $requete = $bdd->prepare('INSERT INTO `opera`(`Type`, Id_access, `Debit`, `Trigramme`, `Etat`) VALUES ("'.$fType.'","'.$fAccess.'","'.$fDebit.'","'.$fTrigramme.'", '.$Etat.')');
        $requete->execute();
        
   
    }
    $data['success'] = true;
    
} else {
  $errors = array($debitErr, $idErr, $triErr, $etatErr, $typeErr);
  $data['success'] = false;
  $data['errors']  = $errors;
}


$data['script'] = $script;
$data["loadpage"] = 'https://'.$_SERVER['HTTP_HOST'].'/BCS';
echo json_encode($data);

?>
