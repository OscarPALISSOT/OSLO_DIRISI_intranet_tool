<?php
  include('connexionbdd.php');

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data





// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
  $data['success'] = false;
  $data['errors']  = $errors;
} else {
  if(!empty($_POST)) {
        
    extract($_POST);
    if($methode == 'POST'){
      $donnees=array();

      if($bureau == '/BPT'){
        $sql = $bdd->prepare("SELECT `ID`, `Nature`, `Zone`,  `N_ASAP`, `N_SERVICE_du_PDC`, `N_RANG`, `Priorisation`, `Bénéficiaire`, `BDD_Impliquée`, `Description_Service`, `Objectifs_et_description_fonctionnelle`, `Montant_FEB`,  `Date_retour_DTS`, `Point_de_situation`, `Chef_de_projet`, `Technicien`, `Trigramme`, `bnrs_finis`.`Id_organisme`, `organisme`.`Nom` FROM bnrs_finis INNER JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme");
        $sql->execute();
        $donnees = $sql->fetchAll();
        $sql->closeCursor();

        $sql = $bdd->prepare("SELECT `ID`, `Nature`, `Zone`, `N_ASAP`, `N_SERVICE_du_PDC`, `N_RANG`, `Priorisation`, `Bénéficiaire`, `BDD_Impliquée`, `Description_Service`, `Objectifs_et_description_fonctionnelle`, `Montant_FEB`, `Date_de_la_demande`, `Echeance_souhaitée`, `Point_de_situation`, `Chef_de_projet`, `Technicien`, `Trigramme`, `organisme`.`Nom` FROM bnrs INNER JOIN organisme ON bnrs.Id_organisme = organisme.Id_organisme");
        $sql->execute();
        $donnees1 = $sql->fetchAll();
         $data['resultat2'] = $donnees1;
         $sql->closeCursor();

        $sql = $bdd->prepare("SELECT `Id_modip`, `Numero_DECLIC`, `Classement_DL`, `Priorite_DECLIC`, `Site`, `Trigramme`, `Classification_Site`, `clients`, `Classification_Operation`, `Cout`, `Description`, `Categorie`, `Type`, `reno_avant`, `reno_apres`, `Annee_Coeur_av_tvx`, `Annee_reno_coeur`, `Annee`, `Semestre`, `Commentaire` FROM modip");
        $sql->execute();
        $donnees3 = $sql->fetchAll();
        $data['resultat3'] = $donnees3;
        $sql->closeCursor();

        $sql = $bdd->prepare("SELECT `Id_modip_actifs`, `Numero_DECLIC`, `Classement_DL`, `Priorite_DECLIC`, `Site`, `Trigramme`, `Classification_Site`, `clients`, `Classification_Operation`, `Cout`, `Description`, `Categorie`, `Type`, `reno_avant`, `reno_apres`, `Annee_Coeur_av_tvx`, `Annee_reno_coeur`, `Annee`, `Semestre` FROM modip_finis");
          $sql->execute();
          $donnees4 = $sql->fetchAll();
          $data['resultat4'] = $donnees4;
          $sql->closeCursor();

      } 
      
      if($bureau == '/BRC'){
    
        $sql = $bdd->prepare("SELECT `ID`, `bnrs_finis`.`Nature`, `Zone`, `N_ASAP`, `N_SERVICE_du_PDC`, `N_RANG`, `Priorisation`, `Bénéficiaire`, `BDD_Impliquée`, `Description_Service`, `Objectifs_et_description_fonctionnelle`, `Montant_FEB`, `Date_retour_DTS`, `Point_de_situation`, `Chef_de_projet`, `Technicien`, `Trigramme`, `bnrs_finis`.`Id_organisme`, `organisme`.`Nom` FROM bnrs_finis LEFT JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme");
        $sql->execute();
        $donnees = $sql->fetchAll();
        $data['resultat'] = $donnees;
        $sql->closeCursor();

        $sql = $bdd->prepare("SELECT `ID`, `Nature`, `Zone`, `N_ASAP`, `N_SERVICE_du_PDC`, `N_RANG`, `Priorisation`, `Bénéficiaire`, `BDD_Impliquée`, `Description_Service`, `Objectifs_et_description_fonctionnelle`, `Montant_FEB`, `Date_de_la_demande`, `Echeance_souhaitée`, `Point_de_situation`, `Chef_de_projet`, `Technicien`, `Trigramme`, `organisme`.`Nom` FROM bnrs INNER JOIN organisme ON bnrs.Id_organisme = organisme.Id_organisme");
        $sql->execute();
        $donnees1 = $sql->fetchAll();
         $data['resultat2'] = $donnees1;
         $sql->closeCursor();

        $sql = $bdd->prepare("SELECT `Id_modip`, `Numero_DECLIC`, `Classement_DL`, `Priorite_DECLIC`, `Site`, `Trigramme`, `Classification_Site`, `clients`, `Classification_Operation`, `Cout`, `Description`, `Categorie`, `Type`, `reno_avant`, `reno_apres`, `Annee_Coeur_av_tvx`, `Annee_reno_coeur`, `Annee`, `Semestre`, `Commentaire` FROM modip");
        $sql->execute();
        $donnees3 = $sql->fetchAll();
        $data['resultat3'] = $donnees3;
        $sql->closeCursor();

        $sql = $bdd->prepare("SELECT `Id_modip_actifs`, `Numero_DECLIC`, `Classement_DL`, `Priorite_DECLIC`, `Site`, `Trigramme`, `Classification_Site`, `clients`, `Classification_Operation`, `Cout`, `Description`, `Categorie`, `Type`, `reno_avant`, `reno_apres`, `Annee_Coeur_av_tvx`, `Annee_reno_coeur`, `Annee`, `Semestre` FROM modip_finis");
          $sql->execute();
          $donnees4 = $sql->fetchAll();
          $data['resultat4'] = $donnees4;
          $sql->closeCursor();

        $sql = $bdd->prepare("SELECT mim3.Id_mim, Master_ID, Type, Debit, Debit_final, IP_PFS, IP_LAN_SUBNET, mim3.Id_organisme, IF(Etat, 'Actif', 'Commande en cours') as Etat, mim3.Id_organisme,Trigramme, Organisme, Date_de_validation, Commentaire FROM mim3" );
          $sql->execute();
          $donnees5 = $sql->fetchAll();
			    $data['resultat5'] = $donnees5;
          $sql->closeCursor();

         
          $sql = $bdd->prepare("SELECT Id_opera, Id_access, `Type`, Debit, opera.Trigramme, quartiers.Nom AS Nom_Quartier, IF(Etat, 'Actif', 'Inactif') as Etat FROM opera LEFT JOIN quartiers on quartiers.Trigramme = opera.Trigramme WHERE Etat =1");
          $sql->execute();
          $donnees7 = $sql->fetchAll();
          $data['resultat7'] = $donnees7;
          $sql->closeCursor();

          $sql = $bdd->prepare("SELECT Id_trv_opera, `Date`, travaux_opera.Debit, Debit_futur, travaux_opera.Trigramme, IF(travaux_opera.Etat, 'Prévus', 'Finis') as Etat, travaux_opera.Id_opera, travaux_opera.Description, opera.Id_access FROM travaux_opera LEFT JOIN opera ON travaux_opera.Id_opera = opera.Id_opera");
          $sql->execute();
          $donnees8 = $sql->fetchAll();
          $sql->closeCursor();
          $data['resultat8'] = $donnees8;
      }
      
      if($bureau == '/BCS'){
        if($role == 'OPERA' || $role =='Admin'){
          $sql = $bdd->prepare("SELECT Id_opera, Id_access, `Type`, Debit, opera.Trigramme, quartiers.Nom AS Nom_Quartier, IF(Etat, 'Actif', 'Inactif') as Etat FROM opera LEFT JOIN quartiers on quartiers.Trigramme = opera.Trigramme WHERE Etat =1");
          $sql->execute();
          $donnees = $sql->fetchAll();
          $sql->closeCursor();

          $sql = $bdd->prepare("SELECT Id_trv_opera, `Date`, travaux_opera.Debit, Debit_futur, travaux_opera.Trigramme, IF(travaux_opera.Etat, 'Prévus', 'Finis') as Etat, travaux_opera.Id_opera, travaux_opera.Description, opera.Id_access FROM travaux_opera LEFT JOIN opera ON travaux_opera.Id_opera = opera.Id_opera");
          $sql->execute();
          $donnees1 = $sql->fetchAll();
          $sql->closeCursor();
          $data['resultat2'] = $donnees1;
        } 
		if($role == 'MIM3' || $role =='Admin'){
          $sql = $bdd->prepare("SELECT mim3.Id_mim, Master_ID, Type, Debit, Debit_final, IP_PFS, IP_LAN_SUBNET, mim3.Id_organisme, IF(Etat, 'Actif', 'Commande en cours') as Etat, mim3.Id_organisme,Trigramme, Organisme, Date_de_validation, Commentaire FROM mim3" );
          $sql->execute();
          $donnees3 = $sql->fetchAll();
          $sql->closeCursor();
			    $data['resultat3'] = $donnees3;

          /*$sql = $bdd->prepare("SELECT Id8_trv_mim, Master_ID, Date, Debit, Debit_futur, Dateintervalle,IF(Etat, 'Prévus', 'Finis') as Etat, NULL,NULL, Id_mim FROM v_mim3" );
          $sql->execute();
          $donnees4 = $sql->fetchAll();
          $sql->closeCursor();
          $data['resultat4'] = $donnees4;*/
          
        }
      }
    
      $data['resultat'] = $donnees;
      $data['success'] = true;
      $data['message'] = 'Success!';
    } else if($methode == 'DELETE'){
      if($bureau == '/BRC'){
        foreach($Id as $value){
          $sql = $bdd->prepare("DELETE FROM bnrs WHERE ID=?" );
          $sql->execute(array($value));
          $sql->closeCursor();
        } 
        foreach($Id as $value){
          $sql = $bdd->prepare("DELETE FROM modip WHERE ID=?" );
          $sql->execute(array($value));
          $sql->closeCursor();
        } 
        foreach($Id as $value){
          $sql = $bdd->prepare("DELETE FROM mim3 WHERE Id_mim=?" );
          $sql->execute(array($value));
          $sql->closeCursor();
        }
        foreach($Id as $value){
          $sql = $bdd->prepare("DELETE FROM travaux_mim3 WHERE Id8_trv_mim=?" );
          $sql->execute(array($value));
          $sql->closeCursor();
        }
      }
        
      else if($bureau == '/BPT'){
        foreach($Id as $value){
          $sql = $bdd->prepare("DELETE FROM modip WHERE ID=?" );
          $sql->execute(array($value));
          $sql->closeCursor();
        } 
      }

      else if($bureau == '/BCS'){
        if($role == 'OPERA' || $role =='Admin'){
          if($source == 1){
            foreach($Id as $value){
              $sql = $bdd->prepare("DELETE FROM opera WHERE Id_opera=?" );
              $sql->execute(array($value));
              $sql->closeCursor();
            } 
          } else if ($source == 2){
            foreach($Id as $value){
              $sql = $bdd->prepare("DELETE FROM travaux_opera WHERE Id_trv_opera=?" );
              $sql->execute(array($value));
              $sql->closeCursor();
            } 
          }
        }  
		if($role == 'MIM3' || $role =='Admin'){
          if($source == 3){
            foreach($Id as $value){
              $sql = $bdd->prepare("DELETE FROM mim3 WHERE Id_mim=?" );
              $sql->execute(array($value));
              $sql->closeCursor();
            } 
          } else if ($source == 4){
            foreach($Id as $value){
              $sql = $bdd->prepare("DELETE FROM travaux_mim3 WHERE Id8_trv_mim=?" );
              $sql->execute(array($value));
              $sql->closeCursor();
            } 
          }
        }
      }

      $data['success'] = true;
      $data['message'] = 'Success!';
      $data['message1'] = $Id;
    }

  } else { 
    
  $data['success'] = false;
  $data['message'] = 'Pas de POST!';
  }      
}

//var_dump(json_encode($data['resultat']));
// return all our data to an AJAX call
echo json_encode($data);