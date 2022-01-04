<style>
.row4{
  font-size: 25px;
}
</style>
<?php


include_once('connexionbdd.php');

function sites($Bdd){
  global $bdd;

  $reponse = $bdd->prepare("SELECT quartiers.*, bdd.Libelle FROM quartiers INNER JOIN bdd on bdd.Numero_BDD=quartiers.Numero_BDD WHERE quartiers.Numero_BDD =?");
  $reponse->execute(array($Bdd));
  $sites = $reponse->fetchAll();
  $reponse->closeCursor();
  return $sites;
}

function listeexport($Bdd){
  global $bdd;

  $reponse = $bdd->prepare("SELECT * FROM v_export WHERE Numero_BDD =? ORDER BY `v_export`.`Trigramme` ASC, v_export.Id_organisme ASC");
  $reponse->execute(array($Bdd));
  $sites = $reponse->fetchAll();
  $reponse->closeCursor();
  return $sites;
}

function nomBDD($Trigramme){
  global $bdd;
  $reponse = $bdd->prepare("SELECT Numero_BDD FROM quartiers WHERE Trigramme =?;");
  $reponse->execute(array($Trigramme));
  if($donnees = $reponse->fetch()){
    $reponse1 = $bdd->prepare("SELECT Libelle FROM bdd WHERE Numero_BDD =?;");
    $reponse1->execute(array($donnees["Numero_BDD"]));
    if($donnees1 = $reponse1->fetch()){
      $reponse1->closeCursor();
      return $donnees1["Libelle"];
    }
    $reponse1->closeCursor();
  }
  $reponse->closeCursor();
  return '';
}

function nomsite($Trigramme){
  global $bdd;
  $reponse = $bdd->prepare("SELECT * FROM quartiers WHERE Trigramme = ?;");
  $reponse->execute(array($Trigramme));
  if($reponse->rowCount()==1){
    $donnees= $reponse->fetch()["Nom"];
    $reponse->closeCursor();
    return $donnees;
  } else {
    return $Trigramme;
  }
  $reponse->closeCursor();
  return '';
}

function organismes($Trigramme){
  global $bdd;

    $reponse = $bdd->prepare("SELECT * FROM v_organisme WHERE Trigramme=?");
    $reponse->execute(array($Trigramme));
    if($reponse->rowCount()){
      if ($donnees = $reponse->fetchAll()){
        $reponse->closeCursor();
        return $donnees;
      }
    }
    $reponse->closeCursor();
    return '';
}

function selectMasterID(){
  global $bdd;

    $reponse = $bdd->prepare("SELECT Master_ID, Id_mim FROM mim3");
    $reponse->execute();
    if($reponse->rowCount()){
      if ($donnees = $reponse->fetchAll()){
        $reponse->closeCursor();
        return $donnees;
      }
    }
    $reponse->closeCursor();
    return '';
}

function selectIDAccess(){
  global $bdd;

    $reponse = $bdd->prepare("SELECT Id_access, Id_opera FROM opera");
    $reponse->execute();
    if($reponse->rowCount()){
      if ($donnees = $reponse->fetchAll()){
        $reponse->closeCursor();
        return $donnees;
      }
    }
    $reponse->closeCursor();
    return '';
}

function selectorganismes(){
  global $bdd;

    $reponse = $bdd->prepare("SELECT * FROM organisme");
    $reponse->execute();
    if($reponse->rowCount()){
      if ($donnees = $reponse->fetchAll()){
        $reponse->closeCursor();
        return $donnees;
      }
    }
    $reponse->closeCursor();
    return '';
}

function infosquartier($Trigramme){
  global $bdd;
 $html='<div class="container">';
$reponse1 = $bdd->prepare("SELECT * FROM quartiers WHERE Trigramme=?");
$reponse1->execute(array($Trigramme));
    if($reponse1->rowCount()==1){
      if($donnees1 = $reponse1->fetch()){
        $html .='<div class="row4">
  <label class="col-auto"><strong>Trigramme: </strong></label>
  <div class="col-auto">'.$donnees1["Trigramme"].'
  </div></div>
  <div class="row4">
    <label for="staticNomsite" class="col-auto"><strong>Identification du quartier: </strong></label>
    <div class="">
     <p>'.$donnees1["Nom"].'<p>
    </div>
  </div>
  <div class="row4">
    <label for="staticAdressesite" class="col-auto"><strong>Adresse du quartier: </strong></label>
    <div class="">
    <p>'.$donnees1["Adresse"].'<p>
    </div>
  </div>
  <div class="row4">
    <label for="staticNomsite" class="col-auto"><strong>RFZ: </strong></label>
    <div class="">
     <p>'.$donnees1["RFZ"].'<p>
    </div>
  </div>';
    include_once("Vue/Formulaires/ModifierQuartier.php");
      }

      $reponse1->closeCursor();
    }
    $html .= "</div>";
    return $html;
}

function nomorganisme($organisme){
  global $bdd;
  $reponse = $bdd->prepare("SELECT * FROM organisme WHERE Id_organisme =?;");
  $reponse->execute(array($organisme));
    if($reponse->rowCount()){
      $html = $reponse->fetch()["nom"];
    } else {
      $html = "Pas d'organisme";
    }
    
    return $html;
}

function opera($Trigramme){
  global $bdd;
  $reponse = $bdd->prepare("SELECT * FROM opera WHERE Trigramme = ? AND Etat=1");
  $reponse->execute(array($Trigramme));
  $html='<div class="container">';
  $html.= '<div class="row"><div class="col"><h1>OPERA</h1></div></div>';
if($reponse->rowCount()){
    if (!empty($donnees1 = $reponse->fetchAll())){

      $html .= '<br><p><strong><u>Actifs</u></strong></p><table class="table table-bordered border-dark">
    <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">ID ACCESS</th>
           <th class="align-middle" scope="col">Type</th>
              <th class="align-middle" scope="col">Débit initial <br> (en Mb/s)</th>
              <th class="align-middle" scope="col">Commentaire</th>
           </tr>
      </thead>

  <tbody>';
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaireOpera2.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Id_access'].'</th>
  <th class="align-middle" scope="row">'. $val['Type'].'</th>
  <td class="align-middle">'. $val['Debit'].'</td>
  <td class="align-middle">'. $val['Description']. '<div class="bouton2 " class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_opera'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
    </tr>';

  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }
  $reponse->closeCursor(); 
} else {
  $html .="<span class='text'>Pas de travaux ou modifications OPERA prévues ou en cours</span><br>";
}
$reponse1 = $bdd->prepare("SELECT * FROM `travaux_opera` WHERE `Etat`= 0 AND Trigramme = ?;");
$reponse1->execute(array($Trigramme));
    if ($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){
    
      $html .= '
      <br><p><strong><u>Prévus</u></strong></p><table class="table table-bordered border-dark">
        <thead style="background-color:#adb5bd;">
  
             <tr>
             <th class="align-middle" scope="col">Date de la demande</th>
             <th class="align-middle" scope="col">Débit initial <br> (en Mb/s)</th>
             <th class="align-middle" scope="col">Débit final <br> (en Mb/s)</th>
             <th class="align-middle" scope="col">Commentaire</th>
             </tr>
        </thead>
  
    <tbody>';
    foreach($donnees1 as $val){
      include('Vue/Formulaires/modifierCommentaireOpera.php');
    $html .= '<tr>
    <th class="align-middle" scope="row">'. $val['Date'].'</th>
    <td class="align-middle">'. $val['Debit'].'</td>
    <td class="align-middle">'. $val['Debit_futur']. '</td>
    <td class="align-middle">'. $val['Description']. '<div class="bouton2 " class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_trv_opera'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
  </div></td>
      </tr>';
  
  
  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }


    $reponse1->closeCursor();
    $html .= "</div>";
} else {
	$html .= "<span class='text'>Pas d'informations OPERA disponibles au sujet de ce site</span><br></div>";
}
  return $html;

}

/*function opera($Trigramme){
  global $bdd;
 $html='<div class="container">';
$reponse = $bdd->prepare("SELECT *, FROM `travaux_opera`  WHERE`Etat`= 1 AND Trigramme= ?;");
$reponse->execute(array($Trigramme));
  $html.= '<div class="row"><div class="col"><h1>OPERA</h1></div></div>';
if($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse->fetchAll())){

    $html .= '
    <br><p><strong><u>Prévus</u></strong></p><table class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Date de la demande</th>
           <th class="align-middle" scope="col">Débit initial <br> (en Mb/s)</th>
           <th class="align-middle" scope="col">Débit final <br> (en Mb/s)</th>
           <th class="align-middle" scope="col">Commentaire<br> (en Mb/s)</th>
           </tr>
      </thead>

  <tbody>';
  foreach($donnees1 as $val){
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Date'].'</th>
  <td class="align-middle">'. $val['Debit'].'</td>
  <td class="align-middle">'. $val['Debit_futur']. '</td>
  <td class="align-middle">'. $val['Commentaire']. '<div class="bouton2 " class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_mim'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
    </tr>';

  }
  $html .= '</div></div>
  </tbody>
  </table>';
  }
  $reponse1->closeCursor(); 
} else {
  $html .= "<span class='text'>Pas de travaux ou modifications OPERA prévus ou en cours.</span><br>";
}
  $reponse2 = $bdd->prepare("SELECT * FROM `opera` WHERE`Etat`=  1 AND Trigramme = ?;");
  $reponse2->execute(array($Trigramme));
    if($reponse2->rowCount()){
    if (!empty($donnees2 = $reponse2->fetchAll())){
   
    $html .= '<br><p><strong><u>ACTIFS</u></strong></p><table class="table table-bordered border-dark">
    <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Type</th>
              <th class="align-middle" scope="col">Débit initial <br> (en Mb/s)</th>
           </tr>
      </thead>

  <tbody>';
  foreach($donnees2 as $val){
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Type'].'</th>
  <td class="align-middle">'. $val['Debit'].'</td>

    </tr>';
   
  }

  $html .= '</div></div>
  </tbody>
  </table>';
  }
 $reponse2->closeCursor();
 

} else {
  $html .= "<span class='text'>Pas d'informations OPERA disponibles au sujet de ce site</span><br>";
}
$html .= "</div>";

return $html;

}*/





function modip($Trigramme){
  global $bdd;
 $html='<div class="container">';
$reponse1 = $bdd->prepare("SELECT * FROM `modip` WHERE  Trigramme = ?");
  $reponse1->execute(array($Trigramme));
  $html.= '<div class="row"><div class="col"><h1>MODIP</h1></div></div>';
if($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){

    $html .= '
    <br><p><strong><u>Prévus</u></strong></p><table class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
            <th class="align-middle" scope="col">Numero DECLIC</th>
              <th class="align-middle" scope="col">Année</th>
              <th class="align-middle" scope="col">Description</th>
              <th class="align-middle" scope="col">Coût <br> (en €)</th>
              <th class="align-middle" scope="col">Commentaire</th>
           </tr>
      </thead>

  <tbody>';
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaireMODIP.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Numero_DECLIC'].'</th>
      <th class="align-middle" scope="row">'. $val['Annee'].'</th>
      <td class="align-middle">'. $val['Description'].'</td>
      <td class="align-middle">'. $val['Cout']. '</td>
      <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_modip'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
    </tr>';

  }
  $html .= '</div></div>
  </tbody>
  </table>';
  }
  $reponse1->closeCursor(); 
} else {
  $html .= "<span class='text'>Pas de modernisation IP prévus ou en cours pour ce site.</span><br>";
}
  
  $reponse2 = $bdd->prepare("SELECT * FROM modip_finis WHERE Trigramme LIKE ?");
  $reponse2->execute(array($Trigramme));
    if($reponse2->rowCount()){
    if (!empty($donnees2 = $reponse2->fetchAll())){
   
    $html .= '<p><strong><u>Actifs</u></strong></p><table class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Numéro DECLIC</th>
              <th class="align-middle" scope="col">Année</th>
              <th class="align-middle" scope="col">Description</th>
              <th class="align-middle" scope="col">Coût <br> (en €)</th>
              <th class="align-middle" scope="col">Commentaire</th>
           </tr>
      </thead>

  <tbody>';
  foreach($donnees2 as $val){
    include('Vue/Formulaires/modifierCommentaireMODIP2.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Numero_DECLIC'].'</th>
      <th class="align-middle" scope="row">'. $val['Annee'].'</th>
      <td class="align-middle">'. $val['Description'].'</td>
      <td class="align-middle">'. $val['Cout']. '</td>
      <td class="align-middle">'. $val['Commentaire1']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_modip_actifs'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
    </tr>';
   
  }

  $html .= '</div></div>
  </tbody>
  </table>';
  }
 $reponse2->closeCursor();
 

} else {
  $html .= "<span class='text'>Pas de modernisations IP finalisés pour ce site.</span><br>";
}
$html .= "</div>";

return $html;

}


function mim3($Trigramme){
  global $bdd;
  
 $html='<div class="container">';
$reponse1 = $bdd->prepare("SELECT *, mim3.Commentaire FROM `mim3` WHERE `Etat`= 0 AND Trigramme = ?");
  $reponse1->execute(array($Trigramme));
  $html.= '<div class="row"><div class="col"><h1>MIM3</h1></div></div>';
if($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){

      $html .= '<p><strong><u>Prévus</u></strong></p><table id="target" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
               <th class="align-middle" scope="col">Date prévue <br>de validation</th>
              <th class="align-middle" scope="col">Débit initial <br>(en Mb/s)</th>
              <th class="align-middle" scope="col">Débit final <br>(en Mb/s)</th>
              <th class="align-middle" scope="col">Organisme <br></th>
              <th class="align-middle" scope="col">Commentaire <br></th>
           </tr>
      </thead>

  <tbody>';
  foreach($donnees1 as $val){
     include('Vue/Formulaires/modifierCommentaire.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Date_de_validation'].'</th>
  <td class="align-middle">'. $val['Debit'].'</td>
  <td class="align-middle">'. $val['Debit_final']. '</td>
  <td class="align-middle">'. $val['Organisme']. '</td>
  <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_mim'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
    </tr>';

  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }
  $reponse1->closeCursor(); 
} else {
  $html .="<span class='text'>Pas de travaux ou modifications MIM3 prévues ou en cours</span><br>";
}
$reponse2 = $bdd->prepare("SELECT mim3.Id_mim, mim3.Type, mim3.Debit, mim3.Id_organisme, mim3.Commentaire, organisme.Nom FROM `mim3` INNER JOIN organisme ON mim3.Id_organisme = organisme.Id_organisme WHERE `Etat`= 1 AND Trigramme = ?");
$reponse2->execute(array($Trigramme));
    if ($reponse2->rowCount()){
    if (!empty($donnees1 = $reponse2->fetchAll())){
    
    $html .= '<p><strong><u>Actifs</u></strong></p><table id="tablemim3v2" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Type</th>
           <th class="align-middle" scope="col">Débit</th>
           <th class="align-middle" scope="col">Organisme</th>
           <th class="align-middle" scope="col">Commentaire <br></th>
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaire.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Type']. '</td>    
  <td class="align-middle">'. $val["Debit"]. ' Mb/s'.'</th>
  <td class="align-middle">'. $val['Nom'].'</th><br>
  <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_mim'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }


    $reponse2->closeCursor();
    $html .= "</div>";
} else {
	$html .= "<span class='text'>Pas d'informations MIM3 disponibles au sujet de ce site</span><br></div>";
}
  return $html;

}





function rfz($Trigramme){
    global $bdd;
  $reponse = $bdd->prepare("SELECT RFZ FROM quartiers WHERE Trigramme=?");
  $reponse->execute(array($Trigramme));
 if ($reponse->rowCount()){
    if ($donnees1 = $reponse->fetchAll()){
     $reponse1 = $bdd->prepare("SELECT * FROM quartiers WHERE RFZ=?");
     $reponse1->execute(array($donnees1[0]['RFZ']));
    
    if ($donnees2 = $reponse1->fetchAll()){
    // var_dump($donnees2);
    
    $reponse->closeCursor();
    $reponse1->closeCursor();
    return $donnees2;
    }
    }}
}



/*function mim3v2($trigramme){
  global $bdd;

$html='<div class="container">';
$html .= '<div class="row"><div class="col"><h1>MIM3 FINIS</h1></div></div> <br>';  

$reponse = $bdd->prepare("SELECT mim3.Id_mim, mim3.Type, mim3.Debit, mim3.Id_organisme, organisme.Nom FROM `mim3` INNER JOIN organisme ON mim3.Id_organisme = organisme.Id_organisme WHERE Trigramme = ?");
$reponse->execute(array($trigramme));
    if ($reponse->rowCount()){
    if (!empty($donnees1 = $reponse->fetchAll())){
    
    $html .= '<p><strong><u>FINIS</u></strong></p><table id="tablemim3v2" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Type</th>
           <th class="align-middle" scope="col">Débit</th>
           <th class="align-middle" scope="col">Organisme</th>  
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Type']. '</td>    
  <td class="align-middle">'. $val["Debit"]. ' Mb/s'.'</th>
  <td class="align-middle">'. $val['Nom'].'</th>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table>';
  }


    $reponse->closeCursor();
} else {
	$html .= "<span class='text'>Pas d'informations MIM3 disponibles au sujet de ce site</span><br></div>";
}
  return $html;

}*/

/*function bnrv3($trigramme){
  global $bdd;

$html='<div class="container">';
$html .= '<div class="row"><div class="col"><h1>BNR</h1></div></div> <br>';  

$reponse1 = $bdd->prepare("SELECT *, `organisme`.`Nom` FROM bnrs INNER JOIN organisme ON bnrs.Id_organisme = organisme.Id_organisme WHERE Trigramme = ?");
$reponse1->execute(array($trigramme));
    if ($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){
    
    $html .= '<p><strong><u>Prévus</u></strong></p><table id="tablebnr" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Date de la demande</th>
              <th class="align-middle" scope="col">Description</th>
              <th class="align-middle" scope="col">Montant estimé <br> (en €) </th>
              <th class="align-middle" scope="col">Date d\'échéance</th>
              <th class="align-middle" scope="col">Organisme</th>
              <th class="align-middle" scope="col">Commentaire</th>
              
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Date_de_la_demande']. '</td>    
  <td class="align-middle">'. $val['Objectifs_et_description_fonctionnelle'].'</th>
      <td class="align-middle">'. $val['Montant_FEB'].'</td>
      <td class="align-middle">'. $val['Echeance_souhaitée']. '</td>
      <td class="align-middle">'. $val['Nom']. '</td>
      <td class="align-middle">'. $val['Commentaire']. '<div class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
    <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_bnr'].' type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
  </div></td>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table>';
  }


    $reponse1->closeCursor();
    $html .= "</div>";
} else {
	$html .= "<span class='text'>Pas d'informations BNR disponibles au sujet de ce site</span><br></div>";
}
$reponse2 = $bdd->prepare("SELECT *, `organisme`.`Nom` FROM bnrs_finis INNER JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme WHERE Trigramme = ?");
$reponse2->execute(array($trigramme));
    if ($reponse2->rowCount()){
    if (!empty($donnees2 = $reponse2->fetchAll())){
    
    $html .= '<p><strong><u>ACTIFS</u></strong></p><table id="tablebnrv3" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">N° ASAP</th>
           <th class="align-middle" scope="col">N° SERVICE du PDC</th>
           <th class="align-middle" scope="col">Organisme</th>  
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees2 as $val){
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['N_ASAP']. '</td>    
  <td class="align-middle">'. $val["	N_SERVICE_du_PDC"]. '</td>
  <td class="align-middle">'. $val['Nom'].'</td><br>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }


    $reponse2->closeCursor();
    $html .= "</div>";
} else {
	$html .= "<span class='text'>Pas d'informations BNR disponibles au sujet de ce site</span><br></div>";
}
  return $html;

}*/

function bnrv3($Trigramme){
  global $bdd;
  
 $html='<div class="container">';
$reponse1 = $bdd->prepare("SELECT *, `organisme`.`Nom` FROM bnrs INNER JOIN organisme ON bnrs.Id_organisme = organisme.Id_organisme WHERE Trigramme = ?");
  $reponse1->execute(array($Trigramme));
  $html.= '<div class="row"><div class="col"><h1>BNR</h1></div></div><br>';
if($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){

      $html .= '<p><strong><u>Prévus</u></strong></p><table id="tablebnr" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Date de la demande</th>
              <th class="align-middle" scope="col">Description</th>
              <th class="align-middle" scope="col">Montant estimé <br> (en €) </th>
              <th class="align-middle" scope="col">Date d\'échéance</th>
              <th class="align-middle" scope="col">Organisme</th>
              <th class="align-middle" scope="col">Commentaire</th>
              
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaireBNR.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Date_de_la_demande']. '</td>    
  <td class="align-middle">'. $val['Objectifs_et_description_fonctionnelle'].'</th>
      <td class="align-middle">'. $val['Montant_FEB'].'</td>
      <td class="align-middle">'. $val['Echeance_souhaitée']. '</td>
      <td class="align-middle">'. $val['Nom']. '</td>
      <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
      <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['ID'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
    </div></td>
      </tr>';

  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }
  $reponse1->closeCursor(); 
} else {
  $html .="<span class='text'>Pas d'informations sur les BNR prévus</span><br><br>";
}
$reponse2 = $bdd->prepare("SELECT *, `organisme`.`Nom` FROM bnrs_finis INNER JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme WHERE Trigramme = ?");
$reponse2->execute(array($Trigramme));
    if ($reponse2->rowCount()){
    if (!empty($donnees1 = $reponse2->fetchAll())){
    
      $html .= '<p><strong><u>Actifs</u></strong></p><table id="tablebnrv3" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">N° ASAP</th>
           <th class="align-middle" scope="col">N° SERVICE du PDC</th>
           <th class="align-middle" scope="col">Organisme</th>
           <th class="align-middle" scope="col">Commentaire</th> 
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaireBNR2.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['N_ASAP']. '</td>    
  <td class="align-middle">'. $val["N_SERVICE_du_PDC"]. '</td>
  <td class="align-middle">'. $val['Nom'].'</td>
  <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
      <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['ID'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
    </div></td>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table>';
  }


    $reponse2->closeCursor();
    $html .= "</div>";
} else {
	$html .= "<span class='text'>Pas d'informations BNR disponibles au sujet de ce site</span><br></div>";
}
  return $html;

}

function bnrv4($organisme, $Trigramme){
  global $bdd;
  
 $html='<div class="container">';
$reponse1 = $bdd->prepare("SELECT *, `organisme`.`Nom` FROM bnrs INNER JOIN organisme ON bnrs.Id_organisme = organisme.Id_organisme WHERE bnrs.Id_organisme = ? AND Trigramme = ?");
  $reponse1->execute(array($organisme, $Trigramme));
  $html.= '<div class="row"><div class="col"><h1>BNR</h1></div></div><br>';
if($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){

      $html .= '<p><strong><u>Prévus</u></strong></p><table id="tablebnr" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Date de la demande</th>
              <th class="align-middle" scope="col">Description</th>
              <th class="align-middle" scope="col">Montant estimé <br> (en €) </th>
              <th class="align-middle" scope="col">Date d\'échéance</th>
              <th class="align-middle" scope="col">Commentaire</th>
              
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaireBNR.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Date_de_la_demande']. '</td>    
  <td class="align-middle">'. $val['Objectifs_et_description_fonctionnelle'].'</th>
      <td class="align-middle">'. $val['Montant_FEB'].'</td>
      <td class="align-middle">'. $val['Echeance_souhaitée']. '</td>
      <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
      <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['ID'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
    </div></td>
      </tr>';

  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }
  $reponse1->closeCursor(); 
} else {
  $html .="<span class='text'>Pas d'informations sur les BNR prévus</span><br><br>";
}
$reponse2 = $bdd->prepare("SELECT * FROM bnrs_finis INNER JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme WHERE bnrs_finis.Id_organisme = ? AND Trigramme = ?");
$reponse2->execute(array($organisme, $Trigramme));
    if ($reponse2->rowCount()){
    if (!empty($donnees1 = $reponse2->fetchAll())){
    
      $html .= '<p><strong><u>Actifs</u></strong></p><table id="tablebnrv3" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">N° ASAP</th>
           <th class="align-middle" scope="col">N° SERVICE du PDC</th> 
           <th class="align-middle" scope="col">Commentaire</th>
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaireBNR2.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['N_ASAP']. '</td>    
  <td class="align-middle">'. $val["N_SERVICE_du_PDC"]. '</td>
  <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
      <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['ID'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
    </div></td>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table>';
  }


    $reponse2->closeCursor();
    $html .= "</div>";
} else {
	$html .= "<span class='text'>Pas d'informations BNR disponibles au sujet de ce site</span><br></div>";
}
  return $html;

}

/*function bnrv4($organisme){
  global $bdd;

$html='<div class="container">';
$html .= '<div class="row"><div class="col"><h1>BNR</h1></div></div> <br>';  

$reponse1 = $bdd->prepare("SELECT * FROM `bnrs` WHERE Id_organisme = ?");
$reponse1->execute(array($organisme));
    if ($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){
    
    $html .= '<p><strong><u>Prévus</u></strong></p><table id="tablebnr" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Date de la demande</th>
              <th class="align-middle" scope="col">Description</th>
              <th class="align-middle" scope="col">Montant estimé <br> (en €) </th>
              <th class="align-middle" scope="col">Date d\'échéance</th>
              
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Date_de_demande']. '</td>    
  <td class="align-middle">'. $val['Description'].'</th>
      <td class="align-middle">'. $val['Montant_estime'].'</td>
      <td class="align-middle">'. $val['Date_d_echeance']. '</td>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table>';
  }


    $reponse1->closeCursor();
} else {
	$html .= "<span class='text'>Pas d'informations BNR disponibles au sujet de ce site</span><br></div>";
}
  return $html;
}*/

function mim3v2($organisme, $Trigramme){
  global $bdd;
  
 $html='<div class="container">';
$reponse1 = $bdd->prepare("SELECT *, organisme.Id_organisme FROM `mim3` INNER JOIN organisme ON mim3.Organisme = organisme.nom WHERE `Etat`= 0 AND organisme.Id_organisme = ? AND Trigramme = ?");
  $reponse1->execute(array($organisme, $Trigramme));
  $html.= '<div class="row"><div class="col"><h1>MIM3</h1></div></div>';
if($reponse1->rowCount()){
    if (!empty($donnees1 = $reponse1->fetchAll())){

      $html .= '<p><strong><u>Prévus</u></strong></p><table id="target" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
               <th class="align-middle" scope="col">Date prévue <br>de validation</th>
              <th class="align-middle" scope="col">Débit initial <br>(en Mb/s)</th>
              <th class="align-middle" scope="col">Débit final <br>(en Mb/s)</th>
              <th class="align-middle" scope="col">Commentaire <br></th>
           </tr>
      </thead>

  <tbody>';
  foreach($donnees1 as $val){
     include('Vue/Formulaires/modifierCommentaire.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Date_de_validation'].'</th>
  <td class="align-middle">'. $val['Debit'].'</td>
  <td class="align-middle">'. $val['Debit_final']. '</td>
  <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_mim'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
    </tr>';

  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }
  $reponse1->closeCursor(); 
} else {
  $html .="<span class='text'>Pas de travaux ou modifications MIM3 prévues ou en cours</span><br><br>";
}
$reponse2 = $bdd->prepare("SELECT *, organisme.Id_organisme FROM `mim3` INNER JOIN organisme ON mim3.Organisme = organisme.nom WHERE `Etat`= 1 AND organisme.Id_organisme = ? AND Trigramme = ?");
$reponse2->execute(array($organisme, $Trigramme));
    if ($reponse2->rowCount()){
    if (!empty($donnees1 = $reponse2->fetchAll())){
    
    $html .= '<p><strong><u>Actifs</u></strong></p><table id="tablemim3v2" class="table table-bordered border-dark">
      <thead style="background-color:#adb5bd;">

           <tr>
           <th class="align-middle" scope="col">Type</th>
           <th class="align-middle" scope="col">Débit</th>
           <th class="align-middle" scope="col">Commentaire <br></th>
           </tr>
      </thead>

  <tbody>';
  
  foreach($donnees1 as $val){
    include('Vue/Formulaires/modifierCommentaire.php');
  $html .= '<tr>
  <th class="align-middle" scope="row">'. $val['Type']. '</td>    
  <td class="align-middle">'. $val["Debit"]. ' Mb/s'.'</th>
  <td class="align-middle">'. $val['Commentaire']. '<div class="bouton" class="cover-container d-flex p-3 mx-auto flex-column col-form-label-lg">
  <button title="Modifier les informations du quartier" class="align-self-sm-end btn" data-bs-toggle="modal" data-bs-target="#edit'.$val['Id_mim'].'" type="button"><img src="../Ressources/images/edit-regular.svg" width="20" /></button>
</div></td>
      </tr>';
  
  }
  $html .= '</div></div>
  </tbody>
  </table><br>';
  }


    $reponse2->closeCursor();
    $html .= "</div>";
} else {
	$html .= "<span class='text'>Pas d'informations MIM3 disponibles au sujet de ce site</span><br></div>";
}
  return $html;

}